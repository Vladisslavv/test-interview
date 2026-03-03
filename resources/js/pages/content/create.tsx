import AppLayout from '@/layouts/app-layout';
import { Textarea } from '@headlessui/react';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { useForm } from '@inertiajs/react';
import { GenerateTextForm } from '@/types';
import { generate } from '@/routes/saved-content'
import React from 'react';

export default function Create(props) {

    const { data, setData, post, errors, processing } = useForm<Required<GenerateTextForm>>({
        message: '',
        max_tokens: '500'
    });

    const handleChange = (e: React.ChangeEvent<HTMLInputElement|HTMLSelectElement>|React.ChangeEvent<HTMLTextAreaElement>) => {
        const { name, value } = e.target;
        setData(name as keyof GenerateTextForm, value);
    };

    const submit = (e) => {
        e.preventDefault();
        post(generate().url, { preserveScroll: true });
    };

    return (
        <AppLayout>
            <form onSubmit={submit} className="p-10">
                <div className="flex flex-col gap-3 mb-3">
                    <Label htmlFor="message">
                        Prompt
                    </Label>
                    <Textarea
                        id="message"
                        className="border-1 border-grey rounded-lg p-4 h-[350px]"
                        name="message"
                        cols={30}
                        rows={50}
                        value={data.message}
                        onChange={handleChange} />
                </div>

                <div className="flex flex-col gap-3 mb-3">
                    <Label htmlFor="message">Max tokens</Label>
                    <Input
                        id="max_tokens"
                        name="max_tokens"
                        type="number"
                        value={data.max_tokens}
                        onChange={handleChange}
                    />
                </div>
                <Button type="submit">Generate text</Button>
            </form>
        </AppLayout>
    );
}
