import React from 'react';
import { Link } from '@inertiajs/react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faChevronLeft, faChevronRight } from '@fortawesome/free-solid-svg-icons';
// https://www.itsolutionstuff.com/post/laravel-react-js-pagination-using-vite-exampleexample.html

interface LinkProps {
    active: boolean;
    url: string;
    label: string;
}
  
export default function Pagination({ links } : {links: Array<LinkProps>}) {
  
    const labelOrIcon = (label: string) => {
        if(label == '<<'){
            return (<FontAwesomeIcon icon={faChevronLeft} />)
        }else if(label == '>>'){
            return (<FontAwesomeIcon icon={faChevronRight} />)
        }else{
            return label;
        }
    }

    function getClassName(active: boolean) {
        if(active) {
            return "mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-carrerablue-100 focus:border-primary focus:text-white bg-carrerablue-200 text-white";
        } else{
            return "mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary";
        }
    }
    // console.log(links);
    // console.log(` links length ${links.length}` );
    return (
        links.length > 3 && (
            <div className="mb-4">
                <div className="flex flex-wrap mt-8">
                    {links.map((link, key) => {
                        link.label = link.label.replace("&laquo; Previous", "<<");
                        link.label = link.label.replace("&laquo; Anterior", "<<");
                        link.label = link.label.replace("Next &raquo;", ">>");
                        link.label = link.label.replace("Próximo &raquo;", ">>");
                        return (
                            link.url === null ?
                                    (<div
                                            className="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                                        >{labelOrIcon(link.label)}</div>) :
  
                                    (<Link
                                                className={getClassName(link.active)}
                                                href={ link.url }
                                            >{labelOrIcon(link.label)}</Link>)
                                    )
                    })}
                </div>
            </div>
        )
    );
}