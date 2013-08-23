/**
 * Simple Javascript Date Picker Control
 *
 * Copyright (c) 2008 Akinwale Ariwodola
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * Usage:
 * rgf_buildCalendar(new Date(), 'myCalDiv', document.form.datePicker, true);
 * where 'myCalDiv' is the ID of the element (e.g. a DIV) that you want to
 * render into and document.form.datePicker is a text input field.
 * 
 */

// Global variables
rgf_months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
rgf_daysOfWeek = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
var rgf_calContainerId = null;
var rgf_dt = new Date();
var rgf_dataField = null;
var rgf_hideOnData = false;

function rgf_isLeapYear(year) {
    return ((year % 4 == 0 && year % 100 != 0) || year % 400 == 0);
}

function rgf_getNumDays(month, year) {
    var numDays = 0;

    // month is 0-based, convert to proper months
    month = month + 1;
    switch (month) {
        case 4: case 6: case 9: case 11: numDays = 30; break;
        case 2: numDays = (rgf_isLeapYear(year)) ? 29 : 28; break;
        default: numDays = 31;
    }
    
    return numDays;
}

function rgf_getFirstDayOfMonthIdx(month, year) {
    var dt = new Date();
    dt.setDate(1); dt.setMonth(month); dt.setFullYear(year);
    return dt.getDay();
}

function rgf_getCurrentYear() {
    return new Date().getFullYear();
}

function rgf_setPreviousMonthAndYear() {
    var curMonth = rgf_dt.getMonth();
    var curYear = rgf_dt.getFullYear();
    if (curMonth == 0) {
        rgf_dt.setMonth(11);
        rgf_dt.setYear(curYear - 1);
    } else {
        rgf_dt.setMonth(curMonth - 1);
    }
    rgf_rebuild();
}

function rgf_setNextMonthAndYear() {
    var curMonth = rgf_dt.getMonth();
    var curYear = rgf_dt.getFullYear();
    if (curMonth == 11) {
        rgf_dt.setMonth(0);
        rgf_dt.setYear(curYear + 1);
    } else {
        rgf_dt.setMonth(curMonth + 1);
    }
    rgf_rebuild();
}

function rgf_rebuild() {
    rgf_buildCalendar(rgf_dt, rgf_calContainerId, rgf_dataField, rgf_hideOnData);
}

// Return format 'YYYY-MM-DD'
// Todo: Support different date formats?
function rgf_setDateData(day, month, year) {
    // 0-padding? What appropriate method?
    month += 1;
    if (month < 10) { month = '0' + month; }
    if (day < 10) { day = '0' + day; }
    
    rgf_dataField.value = year + '-' + month + '-' + day;
    if (rgf_hideOnData) {
        document.getElementById(rgf_calContainerId).style.display = 'none';
    }
}

function rgf_buildCalendar(dt, containerId, tgtDataField, hideOnData) {
    rgf_dt = dt;
    var day = rgf_dt.getDate(); var month = rgf_dt.getMonth(); var year = rgf_dt.getFullYear();
    var numDays = rgf_getNumDays(month, year);
    var firstDayIdx = rgf_getFirstDayOfMonthIdx(month, year);
    var preCols = 0;
    
    var htmlData = '<table class="rgf_cal" cellspacing="1">\r\n';
    htmlData += '<tr class="rgf_cal_h"><td class="rgf_cal_btn" onclick="rgf_setPreviousMonthAndYear()">&lt;</td> <td colspan="5" class="rgf_cc">' + rgf_months[month] + ' ' + year + '</td> <td class="rgf_cal_btn" onclick="rgf_setNextMonthAndYear()">&gt;</td></tr>\r\n';
    htmlData += '<tr class="rgf_day_h"><td>Do</td> <td>Lu</td> <td>Ma</td> <td>Mi</td> <td>Ju</td> <td>Vi</td> <td>Sa</td></tr>\r\n';
    
    for (var pre = 0; pre < firstDayIdx; pre++) {
        if (pre == 0) {
            htmlData += '<tr class="rgf_day_r">';
        }
        
        htmlData += '<td></td>';
        preCols += 1;
    }
    
    for (var i = 0; i < numDays; i++) {
        if ((i + preCols) %7 == 0) {
            htmlData += '</tr>\r\n<tr class="rgf_day_r">'
        }
        htmlData += '<td';
        /*if ((i + 1) == rgf_dt.getDate()) {
            htmlData += ' class="rgf_today"'
        }*/
        htmlData += ' onclick="rgf_setDateData(' + (i+1) + ', ' + month + ',' + year + ')">' + (i+1) + '</td>';
        if (i == numDays - 1) {
            htmlData += '</tr>\r\n';
        }
    }
    
    htmlData += '</table>\r\n';
    
    rgf_dataField = tgtDataField;
    rgf_hideOnData = hideOnData;
    rgf_calContainerId = containerId;
    document.getElementById(rgf_calContainerId).innerHTML = htmlData;
}
