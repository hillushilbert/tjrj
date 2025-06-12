import { useRef, useState, FormEventHandler } from 'react';
import DangerButton from '@/Components/DangerButton';
import Modal from '@/Components/Modal';
import SecondaryButton from '@/Components/SecondaryButton';
import { useForm } from '@inertiajs/react';

export default function DeleteAssuntoForm({ id , className = '',  }: { id: number, className?: string,  }) {
    const [confirmingUserDeletion, setConfirmingUserDeletion] = useState(false);
    const passwordInput = useRef<HTMLInputElement>(null);

    const {
        data,
        setData,
        delete: destroy,
        processing,
        reset,
        errors,
    } = useForm({
        password: '',
    });

    const confirmUserDeletion = () => {
        setConfirmingUserDeletion(true);
    };

    const deleteUser: FormEventHandler = (e) => {
        e.preventDefault();
        destroy(route('assuntos.destroy',id), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => passwordInput.current?.focus(),
            onFinish: () => reset(),
        });
    };

    const closeModal = () => {
        setConfirmingUserDeletion(false);

        reset();
    };

    return (
        <>
            <DangerButton onClick={confirmUserDeletion}>Excluir</DangerButton>

            <Modal show={confirmingUserDeletion} onClose={closeModal}>
                <form onSubmit={deleteUser} className="p-6">
                    <h2 className="text-lg font-medium text-gray-900">
                        Deseja realmente excluir esse registro ?
                    </h2>

                    <p className="mt-1 text-sm text-gray-600">
                        A exclusão será permanente. Deseja realmente continuar ?
                    </p>

                    

                    <div className="mt-6 flex justify-end">
                        <SecondaryButton onClick={closeModal}>Cancelar</SecondaryButton>

                        <DangerButton className="ms-3" disabled={processing}>
                        Excluir
                        </DangerButton>
                    </div>
                </form>
            </Modal>        
        </>


    );
}
