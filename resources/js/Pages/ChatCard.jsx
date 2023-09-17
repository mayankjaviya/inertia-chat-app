import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { usePage } from "@inertiajs/react";
import React from "react";
import { faBars, faCircle, faTrashCan } from "@fortawesome/free-solid-svg-icons";
import moment from "moment";

export default function ChatCard(props){
    const { chat , user ,showModal ,deleteChat } = props;
    const lastOnlineTime = moment(user.last_online_at);
    const isOnline = moment().diff(lastOnlineTime, 'seconds') < 30;

    const [showDelete, setShowDelete] = React.useState({ id: null, show: false});
    const { authUser } = usePage().props;
   const showDeleteIcon = (id,show = false) => {
        setShowDelete({id,show});
    }


    return (
        <>
            <div className="card">
                <div className="card-body">
                    <div className="card-title d-flex align-items-center justify-content-between bg-success rounded-2 px-2 py-2 ">
                        <div className="d-flex align-items-center"><h3 className=" m-2 text-white"><img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/ce54bf11889067.562541ef7cde4.png" className="mx-2" height="40px" /> <span>{user.name}</span></h3><h6 className="text-white m-2 ms-3"><FontAwesomeIcon icon={faCircle} size="2xs" style={{color: "rgb(231 243 166)",}} /> {isOnline ? 'online' : lastOnlineTime.fromNow()}</h6></div>
                        <div className=""><h3 className="m-2 text-white" onClick={ () => { showModal('chat-details-modal',user.name) } }><FontAwesomeIcon icon={faBars} /></h3></div>
                    </div>
                    <hr className="mt-0"/>
                    <div className="messages shadow p-2 rounded-3">
                        { chat.map((item,key) => (
                           item.msg_from == authUser.id ?
                            (
                                <div className={`message my-2 rounded-2 p-2 bg-light text-end text-success`} key={key} onMouseEnter={() => { showDeleteIcon(item.id,true)}} onMouseLeave={() => { showDeleteIcon(item.id)}}>
                                    <span className="fs-5">
                                        {item.message}
                                        <img src="https://www.svgrepo.com/show/382105/male-avatar-boy-face-man-user-5.svg" className="ps-3" height="35px"/>
                                    </span>
                                    {(showDelete.show && showDelete.id == item.id) && <span role="button" onClick={() => deleteChat(item.id,user.name)} className="text-success"><FontAwesomeIcon icon={faTrashCan} size="lg" className="ms-3"/></span> }
                                </div>
                            )
                            :
                            (
                                <div className={`message my-2 rounded-2 p-2 bg-light`} key={key}>
                                    <span className="fs-5">
                                        <img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/ce54bf11889067.562541ef7cde4.png" className="pe-3" height="35px" />
                                        {item.message}
                                    </span>
                                </div>
                            )
                        ))}
                        { (chat.length === 0) && <div className="text-center">No Messages</div>}
                    </div>
                </div>
            </div>
        </>
    );

}
