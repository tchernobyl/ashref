import React, {Component} from 'react';
import { NavItem, Nav, NavDropdown, MenuItem } from 'react-bootstrap';


class HeaderLinks extends Component{
    render(){
        const notification = (
            <div>
                <i className="fa fa-globe"></i>
                <b className="caret"></b>
                <span className="notification">5</span>
                <p className="hidden-lg hidden-md">Notification</p>
            </div>
        );
        return (
            <div>

                <Nav pullRight>

                    <NavItem eventKey={3} href="#/logout">Se déconnecter</NavItem>
                </Nav>
            </div>
        );
    }
}

export default HeaderLinks;
