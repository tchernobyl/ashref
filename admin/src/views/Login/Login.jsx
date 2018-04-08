import React, { Component } from 'react';
import {
    Grid, Row, Col,
    FormGroup, ControlLabel, FormControl
} from 'react-bootstrap';

import {Card} from 'components/Card/Card.jsx';
import {FormInputs} from 'components/FormInputs/FormInputs.jsx';
import Button from 'elements/CustomButton/CustomButton.jsx';
import WebService from 'Api/WebService';

class Login extends Component {

    constructor(props) {
        super(props);
        this.state = {credentials: {email: '', password: ''}}
        this.onChange = this.onChange.bind(this);
        this.onSave = this.onSave.bind(this);
    }

    onChange(event) {
        console.log(555)

        const field = event.target.name;

        const credentials = this.state.credentials;
        console.log('credentials',credentials);
        credentials[field] = event.target.value;
        return this.setState({credentials: credentials});
    }

    onSave(event) {
        var obj=this;
        event.preventDefault();
        WebService.login(this.state.credentials).then(response => {
            console.log('response',response);
            if(response.token){
                sessionStorage.setItem('jwt', response.token);
                sessionStorage.setItem('user', {
                    username:'ameur'
                });
                obj.props.history.push(`/dashboard`)

            }
            else{
                console.log('not success ')
            }

        }).catch(error => {
            throw(error);
        });
    }

    render() {
        return (
            <div className="wrapper">
                <div id="main-panel-login" className="main-panel-login">
                    <div className="content">
                        <Grid fluid>
                            <Col md={3}>
                            </Col>
                            <Col md={6}>
                                <Card
                                    title="Login"
                                    content={
                                        <form>
                                            <FormInputs
                                                ncols = {["col-md-12"]}
                                                proprieties = {[
                                                    {
                                                        name:'email',
                                                        label : "Username ou email",
                                                        type : "text",
                                                        bsClass : "form-control",
                                                        placeholder : "Username ou email",
                                                        onChange:this.onChange
                                                    }
                                                ]}
                                                 />

                                            <FormInputs
                                                ncols = {["col-md-12"]}
                                                proprieties = {[
                                                    {
                                                        name:"password",
                                                        label : "Password",
                                                        type : "password",
                                                        bsClass : "form-control",
                                                        placeholder : "Password",
                                                        onChange:this.onChange
                                                    }
                                                ]}
                                             />

                                            <Button
                                                bsStyle="info"
                                                pullRight
                                                fill
                                                type="submit"
                                                onClick={this.onSave} >
                                                Login
                                            </Button>
                                        </form>
                                    }/>

                            </Col>
                            <Col md={3}>
                            </Col>
                        </Grid>
                    </div>
                </div>
            </div>
        );
    }

}
export default Login;