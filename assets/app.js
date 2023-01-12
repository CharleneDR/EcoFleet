/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

require('bootstrap');

// start the Stimulus application
import './bootstrap';


let start = document.getElementById('search_car_pickUpLocation').value
let end = document.getElementById('search_car_destination').value
function handler(event) {
    event.response.headers['access-control-allow-origin'] = { value: "*" };
    return event.response;
}

fetch('https://maps.googleapis.com/maps/api/distancematrix/json?origins=Washington%2C%20DC&destinations=New%20York%20City%2C%20NY&units=imperial&key=AIzaSyBUrnPC50MWjxUHAVi1RYCRzKAchHhsW54')
    .then(response => response.json())
    .then(connexion => {
        console.log(connexion)
    })


let energies = document.querySelectorAll('.energies')

let carbon = document.getElementsByClassName('carbon')

for (let i = 0; i < energies.length; i++) {
    let vehicle = 4
    if (energies[i].innerHTML == "Electric") {
        vehicle = 5
    }

    fetch('https://api.monimpacttransport.fr/beta/getEmissionsPerDistance?km=250&transportations=' + vehicle)
        .then(response => response.json())
        .then(connexion => {
            carbon[i].innerHTML = connexion[0]['emissions']['kgco2e']
        })
}
