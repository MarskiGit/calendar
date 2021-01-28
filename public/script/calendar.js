'use strict';
import {
    dataFetch,
    displayException
} from './abstract.js';
document.addEventListener('DOMContentLoaded', function () {


    class ViewCalendar {
        constructor() {
            this.btn = document.querySelector('button');
            this.request = {
                action: 'oneMonth',
                year: '2021',
                month: '1'
            };
            this.start()
        }
        start() {
            this.btn.addEventListener('click', () => {

                this.sendRequest()
            })
        }
        sendRequest() {

            dataFetch('ajax.php', this.request).then(data => {
                console.log(data)
            }).finally(console.log('fin'));
        };
    }
    const Calendar = new ViewCalendar()
});