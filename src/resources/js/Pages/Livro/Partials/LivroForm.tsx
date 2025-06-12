import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Link, useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import { FormEventHandler, useEffect, useState } from 'react';
import { Livro } from '@/types';
import DefaultButton from '@/Components/DefaultButton';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faLongArrowAltLeft } from '@fortawesome/free-solid-svg-icons';
import Select, { MultiValue, Options } from 'react-select';
import axios from 'axios';

export default function LivroForm({ livro,  modo = '' }: { livro: Livro, modo?: string }) {
    
    type OptionType = {
        value: string;
        label: string;
    };

    const { data, setData, post: store, patch, errors, processing, recentlySuccessful } = useForm({
        Titulo: livro.Titulo,
        Editora: livro.Editora,
        Edicao: livro.Edicao,
        AnoPublicacao: livro.AnoPublicacao,
        Valor: livro.Valor,
        autores: livro.autores,
        assuntos: livro.assuntos,
    });

    const [autoresOptions, setAutoresOptions] = useState<Options<OptionType>>([]);
    const [autoresSelectedOptions, setAutoresSelectedOptions] = useState<MultiValue<OptionType>>([]);

    const [assuntosOptions, setAssuntosOptions] = useState<Options<OptionType>>([]);
    const [assuntosSelectedOptions, setAssuntosSelectedOptions] = useState<MultiValue<OptionType>>([]);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        if(modo == 'create'){
            store(route('livros.store'));
        }else{
            patch(route('livros.update',{livro: livro.Codl}));
        }
    };

    const handleAutoresChange = (selected: MultiValue<OptionType>) => {
        setAutoresSelectedOptions(selected);
        let aSelected:string[] = [];
        selected.forEach(value => {
            aSelected.push(value.value);
        })
        setData('autores',aSelected);
    };

    const handleAssuntosChange = (selected: MultiValue<OptionType>) => {
        setAssuntosSelectedOptions(selected);
        let aSelected:string[] = [];
        selected.forEach(value => {
            aSelected.push(value.value);
        })
        setData('assuntos',aSelected);
    };

    useEffect(() => {
        
        const fetchAutores = async() => {
            try 
            {

                const response = await axios.get(
                  `/autores/autocomplete/list`
                );

                setAutoresOptions(response.data);

                if(livro.autores != undefined)
                {
                    let rolesSelected:OptionType[] = [];
                    
                    response.data.forEach((roleOption: OptionType) => {
                        livro.autores.forEach(value => {
                            console.log(`value:${value}`);
                            if(roleOption.value == value){
                                rolesSelected.push(roleOption);
                            }
                        });
                    });
                    
                    setAutoresSelectedOptions(rolesSelected);
                }

            } catch (error) {
                console.error('Erro ao buscar opções:', error);
            }
        }

        const fetchAssuntos = async() => {
            try 
            {

                const response = await axios.get(
                  `/assuntos/autocomplete/list`
                );

                setAssuntosOptions(response.data);

                if(livro.assuntos != undefined)
                {
                    let rolesSelected:OptionType[] = [];
                    
                    response.data.forEach((roleOption: OptionType) => {
                        livro.assuntos.forEach(value => {
                            if(roleOption.value == value){
                                rolesSelected.push(roleOption);
                            }
                        });
                    });
                    
                    setAssuntosSelectedOptions(rolesSelected);
                }

            } catch (error) {
                console.error('Erro ao buscar opções:', error);
            }
        }
        // Inicialmente, carregamos todas as opções
        fetchAutores();
        fetchAssuntos();
    }, [livro]);

    return (
        <section >
            <header>
                <h2 className="text-lg font-medium text-gray-900">Cadastro de Livro</h2>

                <p className="mt-1 text-sm text-gray-600">
                    { modo == 'create' ? 'Formulário inclusão de novo Livro' : 'Formulário edução de Livro' }
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="Titulo" value="Título" />

                    <TextInput
                        id="Titulo"
                        className="mt-1 block w-full"
                        value={data.Titulo}
                        onChange={(e) => setData('Titulo', e.target.value)}
                        required
                        isFocused
                        placeholder="Titulo"
                    />

                    <InputError className="mt-2" message={errors.Titulo} />
                </div>
                
                <div>
                    <InputLabel htmlFor="Editora" value="Editora" />

                    <TextInput
                        id="Editora"
                        className="mt-1 block w-full"
                        value={data.Editora}
                        onChange={(e) => setData('Editora', e.target.value)}
                        required
                        isFocused
                        placeholder="Editora"
                    />

                    <InputError className="mt-2" message={errors.Editora} />
                </div>

                <div>
                    <InputLabel htmlFor="Edicao" value="Edição" />

                    <TextInput
                        id="Edicao"
                        type="number"
                        className="mt-1 block w-full"
                        value={data.Edicao}
                        onChange={(e) => setData('Edicao', parseInt(e.target.value))}
                        required
                        isFocused
                        placeholder="Edicao"
                    />

                    <InputError className="mt-2" message={errors.Edicao} />
                </div>
                
                <div>
                    <InputLabel htmlFor="AnoPublicacao" value="Ano Publicação" />

                    <TextInput
                        id="AnoPublicacao"
                        type="number"
                        className="mt-1 block w-full"
                        value={data.AnoPublicacao}
                        onChange={(e) => setData('AnoPublicacao', e.target.value)}
                        required
                        isFocused
                        placeholder="AnoPublicacao"
                    />

                    <InputError className="mt-2" message={errors.AnoPublicacao} />
                </div>
                
                <div>
                    <InputLabel htmlFor="Valor" value="Valor R$" />

                    <TextInput
                        id="Valor"
                        type="number"
                        step=".01"
                        className="mt-1 block w-full"
                        value={data.Valor}
                        onChange={(e) => setData('Valor', parseFloat(e.target.value))}
                        required
                        isFocused
                        placeholder="Valor"
                    />

                    <InputError className="mt-2" message={errors.Valor} />
                </div>
                <div className="mt-6 flex flex-col md:flex-row items-center">
                    <div className="w-full md:w-2/4">
                        <div className="relative w-full pr-1">

                            <InputLabel htmlFor="autores" value="Autores" />

                            <Select 
                                isMulti={true}
                                value={autoresSelectedOptions}
                                options={autoresOptions}
                                onChange={handleAutoresChange}
                                />

                            <InputError message={errors.autores} className="mt-2" />
                        </div>
                    </div> 
                    <div className="w-full md:w-2/4">
                        <div className="relative w-full pl-1">

                            <InputLabel htmlFor="assuntos" value="Assuntos" />

                            <Select 
                                isMulti={true}
                                value={assuntosSelectedOptions}
                                options={assuntosOptions}
                                onChange={handleAssuntosChange}
                                />

                            <InputError message={errors.assuntos} className="mt-2" />
                        </div>
                    </div> 
                </div> 

                <div className="flex items-center gap-4">
                    
                    <Link href={route('livros.index')} className='mr-1'>
                        <DefaultButton>
                            <FontAwesomeIcon icon={faLongArrowAltLeft} className='pr-1' /> Voltar
                        </DefaultButton>
                    </Link>

                    <PrimaryButton disabled={processing}>Salvar</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600">Atualizado!</p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
