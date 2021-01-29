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
            this.dayName;
            this.paramsMonth;
            this.timeZone;
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
            this.h1.innerText = `Kalendarz ${this.year}`
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
            this.dayName = day_name;
            this.paramsMonth = params_month;
            this.timeZone = time_zone;
            this.year = year;

            if (this.paramsMonth.length) {
                this.paramsMonth.forEach(data => {
                    const {
                        month,
                        day_number
                    } = data;;
                    this.div = document.createElement('section');
                    this.div.className = 'month';
                    this.div.setAttribute('data-month', `${month}`);
                    this.div.innerHTML = this.renderHtml(month, day_number);
                    this.calednar.appendChild(this.div);
                });

                this.addDom();
            } else {
                this.calendarContainer.innerHTML = '<div><h4 class="empty_idea">Brak elementów do wyświetlenia.</h4></div>';
            }
        };
        renderHtml(month, day_number) {
            return (`
                <h4>${month}</h4>
                 <div class="day_name">
                    ${this.dayNameSpan()}
                </div>
                <div class="day_number">
                    ${this.dayNumberSpan(day_number)}
                </div>
        `);
        };
        dayNumberSpan(day_number) {
            const day = day_number.map(num => (num) ? `<span>${num}</span>` : '<span></span>');
            return day.join('');
        };
        dayNameSpan() {
            const name = this.dayName.map(name => `<span>${name}</span>`);
            return name.join('');
        }
        addDom() {
            this.calendarContainer.appendChild(this.calednar);
        };
    }
    const Calendar = new ViewCalendar()
});