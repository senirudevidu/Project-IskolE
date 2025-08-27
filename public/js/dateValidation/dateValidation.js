// This js file for date validation
// In your html input tag add 
//          id="date"  if you want to restrict date to today
//          id="date-from" if you want to restrict past dates from today
//          id="date-to" if you want to restrict future dates from today
// Call appropiate function using eventlistener


class DateValidation {
    constructor() {
        this.today = new Date();
        this.todayDay = this.today.getDate();
        this.todayMonth = this.today.getMonth() + 1;
        this.todayYear = this.today.getFullYear();

        if(document.getElementById("date").value) {
            this.dateInput = document.getElementById("date").value;
            this.dateInputDay = new Date(this.dateInput).getDate();
            this.dateInputMonth = new Date(this.dateInput).getMonth() + 1;
            this.dateInputYear = new Date(this.dateInput).getFullYear();
        }
        if(document.getElementById("date-from").value) {
            this.dateInput = document.getElementById("date-from").value;
            this.dateInputDay = new Date(this.dateInput).getDate();
            this.dateInputMonth = new Date(this.dateInput).getMonth() + 1;
            this.dateInputYear = new Date(this.dateInput).getFullYear();
        }
        if(document.getElementById("date-to").value) {
            this.dateInput = document.getElementById("date-to").value;
            this.dateInputDay = new Date(this.dateInput).getDate();
            this.dateInputMonth = new Date(this.dateInput).getMonth() + 1;
            this.dateInputYear = new Date(this.dateInput).getFullYear();
        }
    }

    noFutureDates(){
        // Past dates are valid
        if(this.dateInputYear > this.todayYear) {
            return false;
        } else if(this.dateInputYear === this.todayYear && this.dateInputMonth > this.todayMonth) {
            return false;
        } else if(this.dateInputYear === this.todayYear && this.dateInputMonth === this.todayMonth && this.dateInputDay > this.todayDay) {
            return false;
        } else {
            return true;
        }
    }

    noPastDates(){
        // Future Dates are valid
        if(this.dateInputYear < this.todayYear) {
            return false;
        } else if(this.dateInputYear === this.todayYear && this.dateInputMonth < this.todayMonth) {
            return false;
        } else if(this.dateInputYear === this.todayYear && this.dateInputMonth === this.todayMonth && this.dateInputDay < this.todayDay) {
            return false;
        } else {
            return true;
        }
    }

    onlyToday(){
        if(this.dateInputYear === this.todayYear && this.dateInputMonth === this.todayMonth && this.dateInputDay === this.todayDay) {
            return true;
        } else {
            return false;
        }
    }

}

function restrictFutureDates(){
    const validation = new DateValidation();
    if(!validation.noFutureDates()) {
        alert("Future dates are not allowed.");
    }
}

function restrictPastDates(){
    const validation = new DateValidation();
    if(!validation.noPastDates()) {
        alert("Past dates are not allowed.");
    }
}

function onlyTodayAllowed(){
    const validation = new DateValidation();
    if(!validation.onlyToday()) {
        alert("Only today's date is allowed.");
    }
}