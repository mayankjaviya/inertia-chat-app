import React, { useEffect, useState } from "react";
import ChatCard from "./ChatCard";
import { router } from "@inertiajs/react";
import DataModal from "./Modal";
import moment from "moment";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCircle } from "@fortawesome/free-solid-svg-icons";

export default function chat(props){
    const { users , chat , msg_to , visibleModal , totalMessage , totalMessageSent , totalMessageReceived ,authUser } = props;

    const [chatData, setChatData] = useState([]);
    const [chatUser, setChatUser] = useState(msg_to ? users.find(user => user.name == msg_to) : users[0]);
    useEffect(() => {
        if(users.length > 0){
            getMessages(chatUser);
        }
    },[chat]);

    const getMessages = (user) => {

        let myChat = chat.filter((item) => {

            if(item.msg_to == user.id || item.msg_from == user.id){
                return item;
            }
        })

        setChatUser(user)
        setChatData(myChat);
    }

    const getMessagesRequest = (user) => {
        router.visit(`/chat`,{
            data : {'msg_to':user.name},
            only: ['msg_to','chat','users'],
            preserveScroll: true,
        });
    }

    const showModal = (modal,name) => {
        router.visit(`/chat`,{
            data : {'modal': modal,'msg_to':name},
            only: ['totalMessage',
            'totalMessageSent',
            'totalMessageReceived','msg_to','visibleModal'],
            preserveState: true,
            preserveScroll: true,
        });
    }

    const closeModal = () => {
        router.visit(`/chat`,{
            data : {'msg_to':msg_to},
            only: ['visibleModal'],
            preserveState: true,
            preserveScroll: true,
        });
    }

    const deleteChat = (id,msg_to) => {
        router.visit(`/delete-chat`,{
            data : {'id':id,'msg_to':msg_to},
            method: 'post',
            only: ['chat','msg_to'],
            preserveState: true,
            preserveScroll: true,
        });
    }

    const modalData = {
            'totalMessage' : totalMessage,
            'totalMessageSent' : totalMessageSent,
            'totalMessageReceived' : totalMessageReceived,
    }

    return (
        <>
        <div className="row py-4 px-2 border bg-secondary shadow my-4 ">
            <DataModal show={visibleModal ?? false} modalData={modalData} closeModal={closeModal}/>
            <div className="col-md-4 border-end">
                <ul className="list-group fw-bold border">
                    <li className="list-group-item py-3"><div className="d-flex align-items-center"> <img src="https://www.svgrepo.com/show/382105/male-avatar-boy-face-man-user-5.svg" className="mx-3" height="90px"/> <div><h3>{ authUser.name } </h3><h6>{ authUser.email } </h6></div></div></li>
                    { users.map((user,key) => (

                        <li className={`list-group-item py-3 ${(chatUser.id == user.id) ? 'bg-success text-white' : ''} `} key={key} onClick={() => {getMessagesRequest(user)}}>
                            <div className="d-flex justify-content-between align-items-center"><div><img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/ce54bf11889067.562541ef7cde4.png" className="pe-3" height="35px" /> {user.name}  </div>{ (moment().diff(user.last_online_at, 'seconds') < 30) && <div><FontAwesomeIcon icon={faCircle} size="2xs" style={{color: "#198754",}} /></div>}</div></li>
                    ))}

                </ul>
            </div>
            <div className="col-md-8 mt-2 mt-md-0">
                <ChatCard chat={chatData} user={chatUser} showModal={showModal} deleteChat={deleteChat}/>
            </div>
        </div>
        </>
    );

}
