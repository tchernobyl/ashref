import Dashboard from 'views/Dashboard/Dashboard';
import UserProfile from 'views/UserProfile/UserProfile';
import TableList from 'views/TableList/TableList';
import Typography from 'views/Typography/Typography';
import Icons from 'views/Icons/Icons';
import Maps from 'views/Maps/Maps';
import Notifications from 'views/Notifications/Notifications';
import Upgrade from 'views/Upgrade/Upgrade';
import Logout from 'views/Logout/Logout';
import Client from 'views/Client/Client';
import Showroom from 'views/Showroom/Showroom';
import Product from 'views/Product/Product';
const appRoutes = [
    { path: "/dashboard", name: "Dashboard", icon: "pe-7s-graph", component: Dashboard },
    { path: "/users", name: "Client", icon: "pe-7s-user", component: Client },
    { path: "/showroom", name: "Show Room", icon: "pe-7s-note2", component: Showroom },
    { path: "/product", name: "Products", icon: "pe-7s-note2", component: Product },
    { path: "/produit", name: "Produit", icon: "pe-7s-news-paper", component: Typography },
    { path: "/logout", name: "Se déconnecter", icon: "pe-7s-news-paper", component: Logout },
   /* { path: "/icons", name: "Icons", icon: "pe-7s-science", component: Icons },
    { path: "/maps", name: "Maps", icon: "pe-7s-map-marker", component: Maps },
    { path: "/notifications", name: "Notifications", icon: "pe-7s-bell", component: Notifications },
    { upgrade: true, path: "/upgrade", name: "Upgrade to PRO", icon: "pe-7s-rocket", component: Upgrade },*/
    { redirect: true, path:"/", to:"/dashboard", name: "Dashboard" }
];

export default appRoutes;
