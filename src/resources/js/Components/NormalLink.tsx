import { BaseHTMLAttributes } from 'react';

export default function NormalLink({
    className = '',
    children,
    ...props
}: BaseHTMLAttributes<HTMLBaseElement>) {
    return (
        <a
            {...props}
            className={
                'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none ' +
                'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:border-gray-300 focus:text-gray-700' +
                className
            }
        >
            {children}
        </a>
    );
}
