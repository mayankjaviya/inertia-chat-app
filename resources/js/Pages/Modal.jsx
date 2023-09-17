import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';

function DataModal(props) {
    const { show , modalData , closeModal } = props;

  return (
    <Modal show={show}>
        <Modal.Header closeButton onClick={closeModal}>
          <Modal.Title>Message Details</Modal.Title>
        </Modal.Header>
        <Modal.Body>
            <div className="row">
                <div className="col-6">
                    Total Messages sent :
                </div>
                <div className="col-6">
                    {modalData.totalMessageSent}
                </div>
            </div>
            <div className="row">
                <div className="col-6">
                    Total Messages received :
                </div>
                <div className="col-6">
                    {modalData.totalMessageReceived}
                </div>
            </div>
            <div className="row">
                <div className="col-6">
                    Total Messages :
                </div>
                <div className="col-6">
                    {modalData.totalMessage}
                </div>
            </div>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={closeModal}>
            Close
          </Button>
        </Modal.Footer>
      </Modal>
  );
}

export default DataModal;
