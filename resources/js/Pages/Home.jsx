import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import ChatLayout from '@/Layouts/ChatLayout';

function Home({auth}) {
    return (
        <>
          message
        </>
    );
}

Home.layout = (page) => {
    return(
        <AuthenticatedLayout
                    user = {page.props.auth.user}
                >
                         <ChatLayout children={page} />
                </AuthenticatedLayout>
    )
}
export default Home;
