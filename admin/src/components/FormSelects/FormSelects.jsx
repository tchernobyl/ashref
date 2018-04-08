import React, { Component } from 'react';
import { FormGroup, ControlLabel, FormControl, Row } from 'react-bootstrap';

export class FormSelects extends Component{
    render(){

        return (
            <Row>
                <div key={this.props.skey} className={this.props.ncols}>
                    <FormGroup>
                        <ControlLabel>{this.props.label}</ControlLabel>
                        <select
                            name={this.props.name}
                            onChange={this.props.onChange.bind(this)}
                            className={this.props.bsClass} placeholder={this.props.placeholder}>
                            <option value="">{this.props.placeholder}</option>
                            {
                                this.props.items.map((prop,key) => {
                                    return (
                                        <option value={prop.value}>{prop.text}</option>
                                    )
                                })
                            }
                        </select>
                    </FormGroup>
                </div>
            </Row>
        );
    }
}

export default FormSelects;
