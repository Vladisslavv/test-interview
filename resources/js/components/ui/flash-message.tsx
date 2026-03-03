import { useState } from "react";
import { usePage } from "@inertiajs/react";

export default function FlashMessage() {
    const { flash } = usePage().props;
    const [visible, setVisible] = useState(true);

    if (!flash.success && !flash.error || !visible) return null;

    return (
        <div
            className={`${flash.success ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'} p-3 rounded flex justify-between absolute bottom-2 right-3`}
        >
            <span>{flash.success ?? flash.error}</span>
            <button className="ml-2" onClick={() => setVisible(false)}>
                ✕
            </button>
        </div>
    );
}
