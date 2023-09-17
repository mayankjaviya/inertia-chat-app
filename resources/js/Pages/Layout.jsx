import { Head } from "@inertiajs/react";
import React from "react";

export default function Layout(props) {
    const { children,title } = props;
    return (
        <>
            <Head title={title} />

            <div className="card shadow-lg">
                <div className="card-body">
                    <div className="container-fluid">
                        {children}
                    </div>
                </div>
            </div>

      </>

    );
}
