import { useRef, useState, FormEventHandler } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal';
import SecondaryButton from '@/Components/SecondaryButton';
import TextInput from '@/Components/TextInput';
import { useForm } from '@inertiajs/react';
import { PageProps, Autor } from '@/types';
import PrimaryButton from '@/Components/PrimaryButton';

export default function UpdateAutorForm({ autor , className = '',  }: { autor: Autor, className?: string,  }) {
    const [confirmingUserUpdating, setConfirmingUserUpdating] = useState(false);
    const passwordInput = useRef<HTMLInputElement>(null);

    const {
        data,
        setData,
        patch: patch,
        processing,
        reset,
        errors,
    } = useForm({
        Nome: autor.Nome,
    });



    const confirmUserUpdating = () => {
        setConfirmingUserUpdating(true);
    };

    const updateCompanyCrm: FormEventHandler = (e) => {
        e.preventDefault();

        patch(route('autores.update',autor.CodAu), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => passwordInput.current?.focus(),
            onFinish: () => reset(),
        });
    };

    const closeModal = () => {
        setConfirmingUserUpdating(false);

        reset();
    };

    return (
        <>
            <SecondaryButton onClick={confirmUserUpdating} className='mr-1'>Editar</SecondaryButton>

            <Modal show={confirmingUserUpdating} onClose={closeModal}>
                <form onSubmit={updateCompanyCrm} className="p-6">
                <h2 className="text-lg font-medium text-gray-900">
                        Editar Autor
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
                            Salvar
                        </PrimaryButton>
                    </div>
                </form>
            </Modal>        
        </>


    );
}
