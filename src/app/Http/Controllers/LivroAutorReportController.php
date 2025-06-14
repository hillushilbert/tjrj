<?php

namespace App\Http\Controllers;

use App\Application\Repositories\LivroAutorRepository;
use Illuminate\Http\Request;

class LivroAutorReportController extends Controller
{

    protected LivroAutorRepository $repository;

    public function __construct(LivroAutorRepository $repository)
    {
        $this->repository = $repository;
    }
    //
    public function index(Request $request)
    {
        $dados = $this->repository->getLivroPorAutor();

        $stylesheet = file_get_contents(resource_path('css/report.css'));
        
        $parsed = view('report.livro-autor.content',compact('dados'))->render();
        $header = view('report.livro-autor.header',compact('dados'))->render();
        $footer = view('report.livro-autor.footer',compact('dados'))->render();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);

        $mpdf->AddPage('', // L - landscape, P - portrait 
            '', '', '', '',
            10, // margin_left
            10, // margin right
            23, // margin top
            20, // margin bottom
            0, // margin header
            0
        ); // margin footer

    
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($parsed,2);
        $filename = storage_path("app/livros_por_autor.pdf");
        $content = $mpdf->Output($filename,'S');
        
        $headers = array(
            'Content-Disposition' => 'attachment; filename='.basename($filename),
            'Content-Type' => 'application/download',
            'Content-Description' => 'File Transfer',
            'Content-Length' => strlen($content),
          );

        return response($content,200,$headers);
    }
}
