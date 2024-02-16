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
        const tombom = FAJLNEVEK.getTomb();
        const gombElem = $("kuldgomb")

        $(window).on("kuldes", (event) => {
            for (let index = 0; index < event.detail.length; index++) {
                this.dataService.postAxiosData('/api/mail_senders', event.detail[index])

            }
        })

        $(window).on("csvFel", (event, csvData) => {
            this.uploadCsvData(csvData);
        })

        let index = 0;

        function sendNextRequest() {
            if (index < tombom.length) {
                console.log("while ciklus?");
                this.dataService.postAxiosData("/api/mail_senders", {
                    student_id: this.detail[index].kod,
                    pdf_name: this.detail[index].fajlNev,
                }).then(() => {
                    console.log("Az adat sikeresen elküldve!");
                    index++;
                    sendNextRequest(); // Rekurzív hívás a következő kérés elküldéséhez
                }).catch(error => {
                    console.error("Hiba történt az adatküldés során:", error);
                    // Opcionális: kezeljük a hibát, például újra küldés vagy naplózás
                });
            }
        }

        sendNextRequest();

        $(window).on("kuldes", (event) => {
            //console.log("belépünk ide egyáltalán?")
            console.log(event.detail);
            //sendNextRequest(tombom, event.detail);
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


    megjelenit(list) {
        console.log(list);
    }

    sendNextRequest(tombom, event) {
        
        let index = 0;
        if (index < tombom.length) {
            console.log("while ciklus?");
            this.dataService.postAxiosData("/mail_senders", {
                student_id: event.detail[index].kod,
                pdf_name: event.detail[index].fajlNev,
            }).then(() => {
                console.log("Az adat sikeresen elküldve!");
                index++;
                sendNextRequest(); // Rekurzív hívás a következő kérés elküldéséhez
            }).catch(error => {
                console.error("Hiba történt az adatküldés során:", error);
                // Opcionális: kezeljük a hibát, például újra küldés vagy naplózás
            });
        }
    }



}

export default Controller;