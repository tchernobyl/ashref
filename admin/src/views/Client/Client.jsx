import React, { Component } from 'react';
import {
    Grid, Row, Col,Table,Modal
} from 'react-bootstrap';
import {Card} from 'components/Card/Card.jsx';
import Button from 'elements/CustomButton/CustomButton.jsx';
import {FormInputs} from 'components/FormInputs/FormInputs.jsx';
import WebService from 'Api/WebService';

class Client extends Component {
    constructor(props, context) {
        super(props, context);

        this.handleShow = this.handleShow.bind(this);
        this.handleClose = this.handleClose.bind(this);

        this.state = {
            show: false,
            Clients:[],
            clientobj: {last_name: '', first_name: '',username:'',password:'',email:''}
        };

        this.onChangeClient = this.onChangeClient.bind(this);
        this.onSaveClient = this.onSaveClient.bind(this);
        this.getClients();
    }
    getClients(){
        WebService.ListClient().then(response => {
            if(response.success){
                this.setState({Clients: response.data});
            }

        }).catch(error => {
            throw(error);
        });
    }
    handleClose() {
        this.setState({ show: false });
    }

    handleShow() {
        this.setState({ show: true });
    }

    onChangeClient(event) {
        const field = event.target.name;

        const clientobj = this.state.clientobj;
        clientobj[field] = event.target.value;
        return this.setState({clientobj: clientobj});
    }
    onSaveClient(event) {
        var obj=this;
        event.preventDefault();

        WebService.AddClient(this.state.clientobj).then(response => {
            if(response.success){

            }

        }).catch(error => {
            throw(error);
        });
    }
    render() {

        return (
            <div className="content">
                <Grid fluid>
                    <Row>
                        <Col md={12}>
                            <Button
                                bsStyle="info"
                                pullRight
                                fill
                                onClick={this.handleShow}
                            >
                                Nouveau Client
                            </Button>
                            <Card
                                title="List des clients"
                                content={
                                    <Table striped hover>
                                        <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Nom & Prenom</th>
                                            <th>Email</th>
                                            <th>Adresse</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {
                                            this.state.Clients.map((prop,key) => {
                                                return (
                                                    <tr key={key}>
                                                        <td></td>
                                                        <td>{prop.full_name}</td>
                                                        <td>{prop.email}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                )
                                            })
                                        }
                                        </tbody>
                                    </Table>
                                }
                            />
                        </Col>
                    </Row>
                </Grid>
                <form>
                <Modal show={this.state.show} onHide={this.handleClose} bsSize="large">
                    <Modal.Header closeButton>
                        <Modal.Title>Nouveau Client</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <FormInputs
                            ncols = {["col-md-12"]}
                            proprieties = {[
                                {
                                    name:'last_name',
                                    label : "Nom",
                                    type : "text",
                                    bsClass : "form-control",
                                    placeholder : "Nom",
                                    onChange:this.onChangeClient
                                }
                            ]}
                        />
                        <FormInputs
                            ncols = {["col-md-12"]}
                            proprieties = {[
                                {
                                    name:'first_name',
                                    label : "Prénom",
                                    type : "text",
                                    bsClass : "form-control",
                                    placeholder : "Prénom",
                                    onChange:this.onChangeClient
                                }
                            ]}
                        />
                        <FormInputs
                            ncols = {["col-md-12"]}
                            proprieties = {[
                                {
                                    name:'username',
                                    label : "Username",
                                    type : "text",
                                    bsClass : "form-control",
                                    placeholder : "Username",
                                    onChange:this.onChangeClient
                                }
                            ]}
                        />
                        <FormInputs
                            ncols = {["col-md-12"]}
                            proprieties = {[
                                {
                                    name:'password',
                                    label : "Mots de passe",
                                    type : "text",
                                    bsClass : "form-control",
                                    placeholder : "Mots de passe",
                                    onChange:this.onChangeClient
                                }
                            ]}
                        />
                        <FormInputs
                            ncols = {["col-md-12"]}
                            proprieties = {[
                                {
                                    name:'email',
                                    label : "Email",
                                    type : "text",
                                    bsClass : "form-control",
                                    placeholder : "email",
                                    onChange:this.onChangeClient
                                }
                            ]}
                        />
                    </Modal.Body>
                    <Modal.Footer>
                        <Button onClick={this.onSaveClient}>Enregistre</Button>
                    </Modal.Footer>
                </Modal>
                </form>
            </div>
        );
    }
}

export default Client;
