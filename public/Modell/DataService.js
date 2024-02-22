class DataService {
    constructor() {
        axios.defaults.baseURL = "http://192.168.168.158:8000/api/";//mindig az aktuális laravel futási cím jön ide 
        //**Pl http://localhost:8000 ha localhostot alkalmazunk
        /*http://192.168.168.158:8000/   ha saját IP címről futtatod.
        FONTOS a cors.php ba engedélyezni kell!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        FONTOS ha a student táblában nincs a feltöltendő adatnak megfelelő párja akkor nem működik*/
    }

    uploadCsvData(url, csvData) {
        return axios.post(url, csvData);
    }

    getAxiosData(url, callback) {
        console.log(url)
        axios
            .get(url)
            .then(function (response) {
                //console.log(callback)
                // handle success
                /**
                console.log("Válasz objektum", response);
                console.log("adatok", response.data);
                console.log("Adatok nevek lista", response.data.nevek);
                console.log("status", response.status);
                console.log("Státusz szöveg", response.statusText);
                console.log("Válasz fejléc", response.headers);
                console.log("Válasz konfig", response.config);
                 */

                console.log(response);
                console.log(response.data);
                console.log(response.status);
                console.log(response.statusText);
                console.log(response.header);
                console.log(response.config);
                callback(response.data)
            })
            .catch(function (error) {
                // handle error
                console.log(error);
                //hibaCallback(error)
            })
            .finally(function () {
                // always executed
                console.log("finally")
                //$("#jsonAllapot").append("Kész");                
            });
    }

    postAxiosData(url, data) {
        console.log("Életre kelt!");
        axios
            .post(url, data)
            /*({
                method: 'post',
                url: url,
                data:{
                    student_id: data1,
                    pdf_name: data2
                }
            });*/
            //.post(url, data)
            //    .post(url, data1, data2)
            /*
                .post(url, {
                    student_id : data1,
                    pdf_name: data2,
                })
*/

            .then((response) => {
                console.log("RESP", response);
                console.log(response.status);
            })
            .catch((error) => {
                console.log("hiba", error);
            });

    }

    putAxiosData(url, data) {
        console.log(data);
        console.log(`${url}/${data.id}`);
        axios
            .put(`${url}/${data.id}`, data)
            .then((response) => {
                console.log("RESP", response);
            })
            .catch((error) => {
                console.log("hiba", error);
            })
    }

    deleteAxiosData(url, id) {
        console.log(`${url}/${id}`);
        axios
            .delete(`${url}/${id}`)
            .then((response) => {
                console.log("RESP", response);
            })
            .catch((error) => {
                console.log("hiba", error);
            })
    }
}

export default DataService;