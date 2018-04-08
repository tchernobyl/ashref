import React, { Component } from 'react';
import {
    Grid, Row, Col,Table,Modal
} from 'react-bootstrap';

import {Card} from 'components/Card/Card.jsx';
import Button from 'elements/CustomButton/CustomButton.jsx';
import WebService from 'Api/WebService';
import {FormInputs} from 'components/FormInputs/FormInputs.jsx';
import {FormSelects} from 'components/FormSelects/FormSelects.jsx';
class Showroom extends Component {

    constructor(props, context) {
        super(props, context);

        this.handleShow = this.handleShow.bind(this);
        this.handleClose = this.handleClose.bind(this);

        this.onChangeShowRoom = this.onChangeShowRoom.bind(this);
        this.onSaveShowRoom = this.onSaveShowRoom.bind(this);
        this.state = {
            show: false,
            showrooms:[],
            clients:[],
            itemsclient:[],
            showroom: {city: '', user_id: '',address:'',thumb:'',description:'',type:'',name:''}
        };
        this.getShowRooms();
    }

    getShowRooms(){
        WebService.ListShowRoom().then(response => {
            console.log('response',response)
            if(response.success){
                this.setState({showrooms: response.data});
                this.setState({clients: []});
                var items=[];
                // response.data.clients.map((item,key) => {
                //     items.push({value:item.id,text:item.username})
                // });

                this.setState({itemsclient: items});
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

    onChangeShowRoom(event) {
        const field = event.target.name;
        const showroom = this.state.showroom;
        showroom[field] = event.target.value;
        return this.setState({showroom: showroom});
    }
    onSaveShowRoom(event) {
        var obj=this;

        event.preventDefault();

        WebService.AddShowRoom(this.state.showroom).then(response => {
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
                                    Nouveau Show Room
                                </Button>

                            <Card
                                title="List des show room"
                                content={
                                    <Table striped hover>
                                        <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Adresse</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {
                                            this.state.showrooms.map((prop,key) => {
                                                return (
                                                    <tr key={key}>

                                                        <td>{prop.name}</td>
                                                        <td>{prop.address}</td>
                                                        <td>{prop.description}</td>
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
                        <Modal.Title>Nouveau Show Room</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <FormInputs
                            ncols = {["col-md-12"]}
                            proprieties = {[
                                {
                                    name:'name',
                                    label : "Nom",
                                    type : "text",
                                    bsClass : "form-control",
                                    placeholder : "Nom",
                                    onChange:this.onChangeShowRoom
                                }
                            ]}
                        />
                        <FormInputs
                            ncols = {["col-md-12"]}
                            proprieties = {[
                                {
                                    name:'description',
                                    label : "Description",
                                    type : "text",
                                    bsClass : "form-control",
                                    placeholder : "Description",
                                    onChange:this.onChangeShowRoom
                                }
                            ]}
                        />
                        <FormInputs
                            ncols = {["col-md-12"]}
                            proprieties = {[
                                {
                                    name:'city',
                                    label : "Ville",
                                    type : "text",
                                    bsClass : "form-control",
                                    placeholder : "Ville",
                                    onChange:this.onChangeShowRoom
                                }
                            ]}
                        />
                        <FormInputs
                            ncols = {["col-md-12"]}
                            proprieties = {[
                                {
                                    name:'address',
                                    label : "Adresse",
                                    type : "text",
                                    bsClass : "form-control",
                                    placeholder : "Adresse",
                                    onChange:this.onChangeShowRoom
                                }
                            ]}
                        />
                        <FormSelects
                            ncols = "col-md-12"
                            bsClass = "form-control"
                            label = "Client"
                            name="user_id"
                            placeholder = "Client"
                            onChange={this.onChangeShowRoom}
                            items={this.state.itemsclient}
                            skey="clientSectionid"
                        />
                    </Modal.Body>
                    <Modal.Footer>
                        <Button onClick={this.onSaveShowRoom}>Enregistre</Button>
                    </Modal.Footer>
                </Modal>
                </form>
            </div>

        );
    }
}
export default Showroom;
