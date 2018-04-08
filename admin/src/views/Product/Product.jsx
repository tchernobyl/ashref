import React, { Component } from 'react';
import {
    Grid, Row, Col,Table,Modal
} from 'react-bootstrap';

import {Card} from 'components/Card/Card.jsx';
import Button from 'elements/CustomButton/CustomButton.jsx';
import WebService from 'Api/WebService';
import {FormInputs} from 'components/FormInputs/FormInputs.jsx';
import {FormSelects} from 'components/FormSelects/FormSelects.jsx';
class Product extends Component {

    constructor(props, context) {
        super(props, context);

        this.handleShow = this.handleShow.bind(this);
        this.handleClose = this.handleClose.bind(this);

        this.onChangeProduct = this.onChangeProduct.bind(this);
        this.onSaveProduct = this.onSaveProduct.bind(this);
        this.state = {
            show: false,
            products:[],
            clients:[],
            itemsclient:[],
            product: {city: '', user_id: '',address:'',thumb:'',description:'',type:'',name:''}
        };
        this.getProducts();
    }

    getProducts(){
        WebService.ListProduct().then(response => {
            console.log('response',response)
            if(response.success){
                this.setState({products: response.data});
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

    onChangeProduct(event) {
        const field = event.target.name;
        const product = this.state.product;
        product[field] = event.target.value;
        return this.setState({product: product});
    }
    onSaveProduct(event) {
        var obj=this;

        event.preventDefault();

        WebService.AddProduct(this.state.product).then(response => {
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
                                    Nouveau Produit
                                </Button>

                            <Card
                                title="List des Produits"
                                content={
                                    <Table striped hover>
                                        <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>type</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Model</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {
                                            this.state.products.map((prop,key) => {
                                                return (
                                                    <tr key={key}>

                                                        <td>{prop.name}</td>
                                                        <td>{prop.type}</td>
                                                        <td>{prop.sub_title}</td>
                                                        <td>{prop.description}</td>
                                                        <td>{prop.model}</td>
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
                                    onChange:this.onChangeProduct
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
                                    onChange:this.onChangeProduct
                                }
                            ]}
                        />
                        <FormInputs
                            ncols = {["col-md-12"]}
                            proprieties = {[
                                {
                                    name:'type',
                                    label : "Type",
                                    type : "text",
                                    bsClass : "form-control",
                                    placeholder : "Type",
                                    onChange:this.onChangeProduct
                                }
                            ]}
                        />
                        <FormInputs
                      ncols = {["col-md-12"]}
                      proprieties = {[
                          {
                              name:'title',
                              label : "Title",
                              type : "text",
                              bsClass : "form-control",
                              placeholder : "Title",
                              onChange:this.onChangeProduct
                          }
                      ]}
                    />
                        <FormInputs
                          ncols = {["col-md-12"]}
                          proprieties = {[
                              {
                                  name:'subTitle',
                                  label : "SubTitle",
                                  type : "text",
                                  bsClass : "form-control",
                                  placeholder : "SubTitle",
                                  onChange:this.onChangeProduct
                              }
                          ]}
                        />
                        <FormInputs
                          ncols = {["col-md-12"]}
                          proprieties = {[
                              {
                                  name:'model',
                                  label : "Model",
                                  type : "text",
                                  bsClass : "form-control",
                                  placeholder : "Model",
                                  onChange:this.onChangeProduct
                              }
                          ]}
                        />

                    </Modal.Body>
                    <Modal.Footer>
                        <Button onClick={this.onSaveProduct}>Enregistre</Button>
                    </Modal.Footer>
                </Modal>
                </form>
            </div>

        );
    }
}
export default Product;
