// AssuntoIndex.tsx
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
import DeleteAssuntoForm from './Partials/DeleteAssuntoForm';
import UpdateAssuntoForm from './Partials/UpdateAssuntoForm';


export default function AssuntoIndex({ auth, page, filter }: PageProps<{ page: Paginator, filter: any }>) {

    // console.log(param);
    const formMethods = useForm();

    const editAssunto: FormEventHandler = (e) => {
        // e.preventDefault();
    };

    const [confirmingNewAssunto, setConfirmingNewAssunto] = useState(false);

    const confirmNewAssunto = () => {
        setConfirmingNewAssunto(true);
    };

    const {
        data,
        setData,
        post: store,
        processing,
        reset,
        errors,
    } = useForm({
        Descricao: '',
    });
    
    const closeModal = () => {
        setConfirmingNewAssunto(false);

        reset();
    };

    const createAssunto: FormEventHandler = (e) => {
        e.preventDefault();

        store(route('assuntos.store'), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            // onError: () => passwordInput.current?.focus(),
            onFinish: () => reset(),
        });
    };



    return (
        <AuthenticatedLayout
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Assuntos</h2>}
        >
            <Head title="Assuntos" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">   
                    <div className="bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                        <Filter search={""} filter={filter}>
                            <PrimaryButton onClick={confirmNewAssunto}>Adicionar</PrimaryButton>
                        </Filter>
                        <div className="overflow-x-auto">
                            <table className="w-full text-sm text-left text-gray-500 ">
                                <thead className="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" className="px-4 py-4">Id</th>
                                        <th scope="col" className="px-4 py-3">Descrição</th>
                                        <th scope="col" className="px-4 py-3 text-end md:pr-20">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                {page.data.map(item => (
                                    <tr className="border-b ">
                                        <th scope="row" className="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">{item.codAs}</th>
                                        <td className="px-4 py-3">
                                            {item.Descricao}
                                        </td>
                                        <td className="px-4 py-3 flex items-center justify-end">         
                                            <UpdateAssuntoForm assunto={item}></UpdateAssuntoForm>
                                            <DeleteAssuntoForm id={item.codAs}></DeleteAssuntoForm>
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

            <Modal show={confirmingNewAssunto} onClose={closeModal}>
                <form onSubmit={createAssunto} className="p-6">
                    <h2 className="text-lg font-medium text-gray-900">
                        Criar Assunto
                    </h2>

                    <div className="mt-6">
                        <InputLabel htmlFor="name" value="Nome" />

                        <TextInput
                            id="name"
                            type="text"
                            name="name"
                            value={data.Descricao}
                            onChange={(e) => setData('Descricao', e.target.value)}
                            className="mt-1 block w-3/4"
                            placeholder="Descricao"
                        />

                        <InputError message={errors.Descricao} className="mt-2" />
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
