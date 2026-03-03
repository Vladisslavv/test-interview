import AppLayout from '@/layouts/app-layout';
import { Card, CardContent, CardFooter } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { create, view } from '@/routes/saved-content';
import { router } from '@inertiajs/react';
import { destroy } from '@/routes/saved-content';
import FlashMessage from '@/components/ui/flash-message';

export default function Index(props) {
    const { savedContent } = props;

    const remove = (content) => {
        router.delete(destroy(content).url);
    };

    return (
        <AppLayout>
          <div className="p-10">
              <div className="flex justify-end mb-5">
                  <Button asChild>
                      <a href={create().url}>Generate new text</a>
                  </Button>
              </div>
              {
                  !savedContent.length ? (
                      <Card className="text-center">
                          <CardContent>
                              You do not have any generated content! Please generate to continue!
                          </CardContent>
                      </Card>
                  ) : savedContent.map(text => (
                      <Card className="mb-5" key={text.id}>
                          <CardContent>
                              <p className="line-clamp-3">{text.content}</p>
                              <p>Total tokens: {text.total_tokens}</p>
                          </CardContent>
                          <CardFooter className="flex justify-between">
                              <Button asChild>
                                  <a href={view({content: text}).url}>View</a>
                              </Button>
                              <Button onClick={() => remove(text)}>Delete</Button>
                          </CardFooter>
                      </Card>
                  ))
              }
          </div>
            <FlashMessage />
        </AppLayout>
    );
}
