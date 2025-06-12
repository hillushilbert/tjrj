// LeadSourceIndex.tsx
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useState, FormEventHandler } from 'react';
import { useForm, usePage, Link  } from '@inertiajs/react';
import { Head } from '@inertiajs/react';
import { PageProps, Paginator  } from '@/types';
import Filter from './Partials/Filter';
import Pagination from '@/Components/Pagination';
import SecondaryButton from '@/Components/SecondaryButton';
import Modal from '@/Components/Modal';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import DeleteLeadSourceForm from './Partials/DeleteLivroForm';


export default function LivroIndex({ auth, page, filter }: PageProps<{ page: Paginator, filter: any }>) {


    return (
        <AuthenticatedLayout
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Livros</h2>}
        >
            <Head title="Livros" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">   
                    <div className="bg-white  relative shadow-md sm:rounded-lg overflow-hidden">

                        <Filter search={""} filter={filter}>
                            <Link href={route('livros.create')} className='mr-1'>
                                <PrimaryButton>Adicionar</PrimaryButton>
                            </Link>
                        </Filter>
                        <div className="overflow-x-auto">
                            <table className="w-full text-sm text-left text-gray-500 ">
                                <thead className="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" className="px-4 py-4">Id</th>
                                        <th scope="col" className="px-4 py-3">Titulo</th>
                                        <th scope="col" className="px-4 py-3">Editora</th>
                                        <th scope="col" className="px-4 py-3">Edição</th>
                                        <th scope="col" className="px-4 py-3">Ano Publicação</th>
                                        <th scope="col" className="px-4 py-3">Valor R$</th>
                                        <th scope="col" className="px-4 py-3 text-end md:pr-20">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                {page.data.map(item => (
                                    <tr className="border-b ">
                                        <th scope="row" className="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">{item.Codl}</th>
                                        <td className="px-4 py-3">{item.Titulo}</td>
                                        <td className="px-4 py-3">{item.Editora}</td>
                                        <td className="px-4 py-3">{item.Edicao}</td>
                                        <td className="px-4 py-3">{item.AnoPublicacao}</td>
                                        <td className="px-4 py-3">{item.Valor}</td>
                                        <td className="px-4 py-3 flex items-center justify-end">         
                                            <Link href={route('livros.edit',item.Codl)} className='mr-1'>
                                                <SecondaryButton>Editar</SecondaryButton>
                                            </Link>
                                            <DeleteLeadSourceForm id={item.id}></DeleteLeadSourceForm>
                                        </td>
                                    </tr>
                                )) }    
                                </tbody>
                            </table>
                            <Pagination links={page.links} />
                        </div>
                    </div>
                </div>
            </div>

            

        </AuthenticatedLayout>
    );
};
