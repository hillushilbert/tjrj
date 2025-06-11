// AutorIndex.tsx
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
import DeleteAutorForm from './Partials/DeleteAutorForm';
import UpdateAutorForm from './Partials/UpdateAutorForm';


export default function AutorIndex({ auth, page, filter }: PageProps<{ page: Paginator, filter: any }>) {

    // console.log(param);
    const formMethods = useForm();

    const editAutor: FormEventHandler = (e) => {
        // e.preventDefault();
    };

    const [confirmingNewAutor, setConfirmingNewAutor] = useState(false);

    const confirmNewAutor = () => {
        setConfirmingNewAutor(true);
    };

    const {
        data,
        setData,
        post: store,
        processing,
        reset,
        errors,
    } = useForm({
        Nome: '',
    });
    
    const closeModal = () => {
        setConfirmingNewAutor(false);

        reset();
    };

    const createAutor: FormEventHandler = (e) => {
        e.preventDefault();

        store(route('autores.store'), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            // onError: () => passwordInput.current?.focus(),
            onFinish: () => reset(),
        });
    };



    return (
        <AuthenticatedLayout
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Autores</h2>}
        >
            <Head title="Autores" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">   
                    <div className="bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                        <Filter search={""} filter={filter}>
                            <PrimaryButton onClick={confirmNewAutor}>Adicionar</PrimaryButton>
                        </Filter>
                        <div className="overflow-x-auto">
                            <table className="w-full text-sm text-left text-gray-500 ">
                                <thead className="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" className="px-4 py-4">Id</th>
                                        <th scope="col" className="px-4 py-3">Nome</th>
                                        <th scope="col" className="px-4 py-3 text-end md:pr-20">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                {page.data.map(item => (
                                    <tr className="border-b ">
                                        <th scope="row" className="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">{item.CodAu}</th>
                                        <td className="px-4 py-3">
                                            {item.Nome}
                                        </td>
                                        <td className="px-4 py-3 flex items-center justify-end">         
                                            <UpdateAutorForm autor={item}></UpdateAutorForm>
                                            <DeleteAutorForm id={item.CodAu}></DeleteAutorForm>
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

            <Modal show={confirmingNewAutor} onClose={closeModal}>
                <form onSubmit={createAutor} className="p-6">
                    <h2 className="text-lg font-medium text-gray-900">
                        Criar Autor
                    </h2>

                    <div className="mt-6">
                        <InputLabel htmlFor="name" value="Nome" />

                        <TextInput
                            id="name"
                            type="text"
                            name="name"
                            value={data.Nome}
                            onChange={(e) => setData('Nome', e.target.value)}
                            className="mt-1 block w-3/4"
                            placeholder="Nome"
                        />

                        <InputError message={errors.Nome} className="mt-2" />
                    </div>

                    <div className="mt-6 flex justify-end">
                        <SecondaryButton onClick={closeModal}>Cancelar</SecondaryButton>

                        <PrimaryButton className="ms-3" disabled={processing}>
                            Criar
                        </PrimaryButton>
                    </div>
                </form>
            </Modal>

        </AuthenticatedLayout>
    );
};
