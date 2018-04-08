
//TODO move this var to the env file
let BaseUrl="http://127.0.0.1:8000";
class WebService {


    static login(credentials) {
        console.log('credentials 3',credentials)
        var cre={
            "_username":credentials.email,
            "_password":credentials.password
        };
        console.log('login api was called ')
        const request = new Request(BaseUrl+'/api/login_check', {
            method: 'POST',
            headers: new Headers({
                'Content-Type': 'application/json'
            }),
            body: JSON.stringify(cre)
        });


        return fetch(request).then(response => {
            return response.json();
        }).catch(error => {
            return error;
        });
    }

    static ListClient(){
        const request = new Request(BaseUrl+'/api/admin/clients', {
            method: 'GET',
            headers: new Headers({
                'Content-Type': 'application/json',
                'authorization':'Bearer '+sessionStorage.getItem('jwt')
            }),
           // body: JSON.stringify(credentials)
        });


        return fetch(request).then(response => {
            return response.json();
        }).catch(error => {
            return error;
        });
    }


    static AddClient(client){
        const request = new Request(BaseUrl+'/api/admin/client', {
            method: 'POST',
            headers: new Headers({
                'Content-Type': 'application/json',
                'authorization':'Bearer '+sessionStorage.getItem('jwt')
            }),
             body: JSON.stringify(client)
        });


        return fetch(request).then(response => {
            return response.json();
        }).catch(error => {
            return error;
        });
    }


    static ListShowRoom(){
        const request = new Request(BaseUrl+'/api/admin/showrooms', {
            method: 'GET',
            headers: new Headers({
                'Content-Type': 'application/json',
                'authorization':'Bearer '+sessionStorage.getItem('jwt')
            }),
            // body: JSON.stringify(credentials)
        });


        return fetch(request).then(response => {
            return response.json();
        }).catch(error => {
            return error;
        });
    }

    static AddShowRoom(ShowRoom){
        const request = new Request(BaseUrl+'/api/admin/showroom', {
            method: 'POST',
            headers: new Headers({
                'Content-Type': 'application/json',
                'authorization':'Bearer '+sessionStorage.getItem('jwt')
            }),
            body: JSON.stringify(ShowRoom)
        });


        return fetch(request).then(response => {
            return response.json();
        }).catch(error => {
            return error;
        });
    }

    static ListProduct(){
        const request = new Request(BaseUrl+'/api/admin/products', {
            method: 'GET',
            headers: new Headers({
                'Content-Type': 'application/json',
                'authorization':'Bearer '+sessionStorage.getItem('jwt')
            }),
            // body: JSON.stringify(credentials)
        });


        return fetch(request).then(response => {
            return response.json();
        }).catch(error => {
            return error;
        });
    }
    static AddProduct(ShowRoom){
        const request = new Request(BaseUrl+'/api/admin/product', {
            method: 'POST',
            headers: new Headers({
                'Content-Type': 'application/json',
                'authorization':'Bearer '+sessionStorage.getItem('jwt')
            }),
            body: JSON.stringify(ShowRoom)
        });


        return fetch(request).then(response => {
            return response.json();
        }).catch(error => {
            return error;
        });
    }
}

export default WebService;