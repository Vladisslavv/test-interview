import { router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { destroy } from '@/routes/saved-content';

export default function View(props) {
    const { content } = props;

    const remove = () => {
        router.delete(destroy(content).url);
    }

    return (
        <AppLayout>
            <div className="p-10">
                <p>{content.content}</p>
                <p className="mt-10">Total tokens: {content.total_tokens}</p>
                <Button className="mt-10" onClick={remove}>Delete</Button>
            </div>
        </AppLayout>
    );
}
