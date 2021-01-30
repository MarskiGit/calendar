'use strict';
import {
    dataFetch,
    displayException
} from './abstract.js';
document.addEventListener('DOMContentLoaded', function () {


    class ViewCalendar {
        constructor() {
            this.h1 = document.querySelector('[data-header="h1"]');
            this.calendarContainer = document.querySelector('[data-calendar="container"]');
            this.calednar = document.createDocumentFragment();
            this.date = new Date;
            this.year = this.date.getFullYear()
            this.request = {
                action: 'fullyear',
                year: `${this.year}`,
                month: '1'
            };
            this.sendRequest()
        }
        sendRequest() {
            dataFetch('ajax.php', this.request).then(calendarData => {
                (calendarData.exception) ? displayException(calendarData): this.renderMonth(calendarData);
            }).finally(console.log('fin'));
        };
        renderMonth({
            day_name,
            params_month,
            time_zone,
            year
        }) {
            this.h1.innerText = `${year}`;
            this.paramsMonth = params_month;
            this.timeZone = time_zone;
            if (this.paramsMonth.length) {
                this.paramsMonth.forEach(({
                    month,
                    day_number
                }) => {
                    const div = document.createElement('section');
                    div.className = 'month';
                    div.setAttribute('data-month', `event`);
                    div.innerHTML = this.renderHtml(month, day_number, day_name);
                    this.calednar.appendChild(div);
                });

                this.addDom();
            } else {
                this.calendarContainer.innerHTML = '<div><h4 class="empty_idea">Brak elementów do wyświetlenia.</h4></div>';
            };
        };
        renderHtml(month, day_number, day_name) {
            return (`
                <h4>${month.name}</h4>
                 <div class="day_name">
                    ${this.getDayName(day_name)}
                </div>
                <div class="day_number" data-month='${month.number}'>
                    ${this.getDayNumber(day_number)}
                </div>
        `);
        };
        getDayNumber = day_number => day_number.map(num => (num) ? `<span class="active" data-day='${num}'>${num}</span>` : '<span></span>').join('');
        getDayName = day_name => day_name.map((name, index) => (index === 5 || index === 6) ? `<span class="week">${name}</span>` : `<span>${name}</span>`).join('');
        addDom() {
            this.calendarContainer.appendChild(this.calednar);
        };
    };

    const Calendar = new ViewCalendar();

});