import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export interface Paginator {
    data: Array<any>,
    links: Array<any>,
    per_page: number,
    current_page: number,
    path: string,
    total: number,
    last_page: number
}

export interface FilterInputs {
    search: string,
}

export interface Autor {
    CodAu: number,
    Nome: string,
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
