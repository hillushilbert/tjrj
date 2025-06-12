import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { PageProps, Livro } from '@/types';
import LivroForm from './Partials/LivroForm';

export default function Edit({ auth, data }: PageProps<{ data: any }>) {
    console.log(data.data);
    return (
        <AuthenticatedLayout
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Editar Livro</h2>}
        >
            <Head title="Editar Livro" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                     <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <LivroForm
                            modo={'edit'}
                            livro={data.data}
                        />
                    </div>



                </div>
            </div>
        </AuthenticatedLayout>
    );
}
