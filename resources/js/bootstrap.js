import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/* Importando framework bootstrap */
import "bootstrap";

/* Importando sweet Alert */
import Swal from "sweetalert2";
window.Swal = Swal;
