import { usePage } from "@inertiajs/react";
import { useEffect, useState } from "react";

const ChatLayout = ({children}) => {


    const page = usePage();
    const conversations = page.props.conversations;
    const selectedConversations = page.props.selectedConversations;
    const [localConversations , setLocalConversations] = useState([]);
    const [sortedConversations , setSortedConversations] = useState([]);
    const [onlineusers , setonlineusers] = useState({});
    const isUserOnline = (userId) => onlineusers(userId);
    console.log('conversation' , conversations);
    console.log('selectConversation' , selectedConversations);
    useEffect(() => {
        setSortedConversations(
            localConversations.sort((a ,b) => {
                if(a.blocked_at && b.blocked_at){
                    return a.blocked_at > b.blocked_at ? 1 : -1
                }else if(a.blocked_at) {
                    return 1
                }else if(b.blocked_at) {
                    return -1
                }
                if(a.last_message_date && b.last_message_date) {
                    return b.last_message_date.localeCompare(
                        a.last_message_date
                    );

                }else if(a.last_message_date) {
                    return -1;
                }else if(b.last_message_date) {
                    return 1
                }else {
                    return 0
                }
            })
        );
    } , [localConversations])
    useEffect(() => {
        setLocalConversations(conversations);
    } , [conversations])

    useEffect(() => {
            Echo.join('online')
            .here((users) => {
                const onlineUsersObj = Object.fromEntries(
                    users.map((user) => [user.id , user])
                );

                setonlineusers((prevOnlineUsers) => {
                    return { ...prevOnlineUsers , ...onlineUsersObj}
                });
            })
            .joining((user) => {
                setonlineusers((prevOnlineUsers) => {
                    const updatedUsers = {...prevOnlineUsers};
                    updatedUsers[user.id] = user ;
                    return updatedUsers;
                });
            })
            .leaving((user) => {
                setonlineusers((prevOnlineUsers) => {
                    const updatedUsers = { ...prevOnlineUsers} ;
                    delete updatedUsers[user.id];
                    return updatedUsers;
                })
            })
            .error((error) => {
                console.error('error' , error);
            });
        return () => {
            Echo.leave('online')
        }
    } , [])

        return (
            <>

            </>

        )
}
export default ChatLayout;
