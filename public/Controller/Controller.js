import FajlNevek from "../View/FajlNevek.js";
import DataService from "../Modell/DataService.js";
import CsvFile from "../View/CsvFile.js";

const ALAPVEGPONT = "api/mail_senders";
class Controller {
    constructor() {
        const szuloElem = $("#tarolo")
        const FAJLNEVEK = new FajlNevek(szuloElem);
        const CSVFORM = new CsvFile($("#csvFeltoltes"));
        this.dataService = new DataService();

        $(window).on("kuldes", (event) => {
            for (let index = 0; index < event.detail.length; index++) {
                this.dataService.postAxiosData('/api/mail_senders', event.detail[index])

            }
        })

        $(window).on("csvFel", (event, csvData) => {
            this.uploadCsvData(csvData);
        })

    }

    uploadCsvData(csvData) {
        console.log("Hello2");
        this.dataService.uploadCsvData("/api/upload_csv", csvData)

            .then(response => {
                console.log("Hello3");
                console.log(response.data.message);

            })
            .catch(error => {
                console.error("Hiba a CSV fájl feltöltése közben:", error);
            });
    }
}

export default Controller;