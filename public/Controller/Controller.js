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
        const JSONCREATE = $('#jsonCreate');
        const EMAILSEND = $('#emailSend');
        const jsonKi = $("jsonAllapot");

        JSONCREATE.on('click', () => {
            this.dataService.getAxiosData('data_jsonbe', (data) => {
                console.log(data);
                $("#jsonAllapot").append("Kész");
            });

        });

        EMAILSEND.on('click', () => {
            console.log("Click");
            this.dataService.getAxiosData('email_pdfel', (data) => {
                console.log(data);
                $("#emailAllapot").append("Kész");
            });
        });


        $(window).on("kuldes", (event) => {
            for (let index = 0; index < event.detail.length; index++) {
                this.dataService.postAxiosData('mail_senders', event.detail[index])

            }
        })

        $(window).on("csvFel", (event, csvData) => {
            this.uploadCsvData(csvData);
        })

    }

    uploadCsvData(csvData) {
        this.dataService.uploadCsvData("/api/upload_csv", csvData)

            .then(response => {
                console.log(response.data.message);

            })
            .catch(error => {
                console.error("Hiba a CSV fájl feltöltése közben:", error);
            });
    }
}

export default Controller;