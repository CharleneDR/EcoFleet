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


let element = document.getElementById('search_car_pickUpLocation')
let start = element.options[element.selectedIndex].text
let end = document.getElementById('search_car_destination').value
let energies = document.querySelectorAll('.energies')
let carbon = document.getElementsByClassName('carbon')


fetch('/api')
    .then(response => response.json())
    .then(connexion => {
        fetch('https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/distancematrix/json?origins=' + start + '&destinations=' + end + '&key=' + connexion)
            .then(response => response.json())
            .then(distance => {
                for (let i = 0; i < energies.length; i++) {
                    let vehicle = 4
                    if (energies[i].innerHTML == "Electric") {
                        vehicle = 5
                    }

                    fetch('https://api.monimpacttransport.fr/beta/getEmissionsPerDistance?km=' + distance['rows'][0]['elements'][0]['distance']['value'] / 1000 + '&transportations=' + vehicle)
                        .then(response => response.json())
                        .then(distance => {
                            carbon[i].innerHTML = Math.ceil(distance[0]['emissions']['kgco2e'])
                        })
                }

            })
    })

