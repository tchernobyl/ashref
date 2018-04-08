import React, { Component } from 'react';

class Logout extends Component {

    constructor(props) {
        super(props);
console.log("logout");
        sessionStorage.setItem("jwt","");
        sessionStorage.setItem('user',"");
        this.props.history.push(`/login`) ;

    }
    render() {
        return (
            <div className="wrapper">

            </div>
        );
    }

}
export default Logout;