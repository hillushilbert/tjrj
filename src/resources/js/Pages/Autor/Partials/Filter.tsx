import { useRef, FormEventHandler, PropsWithChildren } from 'react';
import { FilterInputs } from '@/types';
import FilterForm from '@/Components/FilterForm';

export default function Filter({ search, filter, children }: PropsWithChildren & { search: String, filter: FilterInputs}) {


    return (<>
        <FilterForm routeName={"autores.index"} filter={filter} >
            {children}
        </FilterForm>
    </>);
}