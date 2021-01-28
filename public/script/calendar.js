'use strict';
import {
    dataFetch,
    displayException
} from './abstract.js';
document.addEventListener('DOMContentLoaded', function () {


    class ViewCalendar {
        constructor() {
            this.btn = document.querySelector('button');
            this.date = new Date;
            this.year = this.date.getFullYear()
            this.request = {
                action: 'fullyear',
                year: `${this.year}`,
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

            dataFetch('ajax.php', this.request).then(calendarData => {
                console.log(calendarData)
            }).finally(console.log('fin'));
        };
    }
    const Calendar = new ViewCalendar()
});