export const validationRules = {
  username: {
    required: true,
    minlength: 5,
    maxlength: 25,
    pattern: /^[a-zA-Z0-9_]+$/,
    message: {
      required: "Please Enter a username.",
      pattern: "Only letters, numbers & underscores allowed.",
    },
  },
  email: {
    required: true,
    pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    message: {
      required: "Email is required",
      pattern: "Please enter valid email.",
    },
  },
  phone: {
    required: true,
    length: 10,
    pattern: /^0\d{9}$/,
    message: {
      required: "Phone number is required.",
      pattern: "Please enter valid phone number (070xxxxxxx).",
    },
  },
  dob: {
    required: true,
    message: {
      required: "Date of birth is required",
    },
  },
  fName: {
    required: true,
    minlength: 3,
    maxlength: 30,
    pattern: /^[A-Za-z]+$/,
    message: {
      required: "First name is required",
      pattern: "Please enter valid name(only letters)",
    },
  },
  lName: {
    required: true,
    minlength: 3,
    maxlength: 30,
    pattern: /^[A-Za-z]+$/,
    message: {
      required: "Last name is required ",
      pattern: "Please enter valid name(only letters)",
    },
  },
  studentIndex: {
    required: true,
    length: 6,
    pattern: /^\d{6}$/,
    message: {
      required: "Student index is required",
      pattern: "Please enter valid index number(XXXXXX)",
    },
  },
  gender: {
    required: true,
    pattern: "",
    message: {
      required: "Please select gender",
    },
  },
  userType: {
    required: true,
    pattern: "",
    message: {
      required: "Please select user type",
    },
  },
  nic: {
    required: false,
    // length: 12,
    pattern: /^0\d{12}$/,
    message: {
      required: "NIC number is required",
      pattern: "Please enter valid NIC number",
    },
  },
  addressL1: {
    required: true,
    minlength: 3,
    maxlength: 50,
    // pattern: /^[a-zA-Z0-9_]+$/,
    message: {
      required: "Address 1ine 1 is required",
      pattern: "Please enter valid address line 1",
    },
  },
  addressL2: {
    required: true,
    minlength: 3,
    maxlength: 50,
    // pattern: /^[a-zA-Z0-9_]+$/,
    message: {
      required: "Address line 2 is required",
      pattern: "Please enter valid address line 2",
    },
  },
  addressL3: {
    required: false,
    minlength: 3,
    maxlength: 50,
    // pattern: /^[a-zA-Z0-9_]+$/,
    message: {
      required: "Address line 3 is required",
      pattern: "Please enter valid address line 3",
    },
  },
  grade: {
    required: true,
    pattern: /^(?:[2-9]|10)$/,
    message: {
      required: "Grade is required",
      pattern: "Grade must be between 1 and 11",
    },
  },
  class: {
    required: true,
    message: {
      required: "class is required",
    },
  },
  subject: {
    required: true,
    pattern: "",
    message: {
      required: "Please select subject",
    },
  },

  relationship: {
    required: true,
    message: {
      required: "Please select relationship type",
    },
  },

  password: {
    required: true,
    minlength: 8,
    messages: {
      required: "Password required",
      minlength: "Password must be at least 8 characters",
    },
  },

  confirmPassword: {
    required: true,
    equalTo: "password",
    messages: {
      equalTo: "Passwords do not match",
    },
  },

  eventName: {
    required: true,
    minlength: 3,
    maxlength: 40,
    pattern: /^.+$/,
    message: {
      required: "Enter Event name",
      pattern: "Please enter event name",
    },
  },
  date: {
    required: true,
    message: {
      required: "Select a date",
    },
  },
  time: {
    required: true,
    message: {
      required: "Select a Time",
    },
  },

  discription: {
    required: true,
    minlength: 5,
    maxlength: 200,
  },

  // Annocement
  eventName: {
    required: true,
    minlength: 3,
    maxlength: 40,
    pattern: /^.+$/,
    message: {
      required: "Enter Event name",
      pattern: "Please enter event name",
    },
  },
  massage: {
    required: true,
    minlength: 3,
    maxlength: 500,
    pattern: /^.+$/,
    message: {
      required: "Enter massage",
      pattern: "Please enter massage",
    },
  },
  announcementTitle: {
    required: true,
    minlength: 3,
    maxlength: 100,
    pattern: /^.+$/,
    message: {
      required: "Announcement title is required",
      pattern: "Please enter a valid announcement title",
    },
  },
  announcementMessage: {
    required: true,
    minlength: 10,
    maxlength: 1000,
    pattern: /^.+$/,
    message: {
      required: "Announcement message is required",
      pattern: "Please enter a valid announcement message",
    },
  },
  targetAudience: {
    required: true,
    pattern: "",
    message: {
      required: "Please select target audience",
    },
  },
  eventTitle: {
    required: true,
    minlength: 3,
    maxlength: 100,
    pattern: /^.+$/,
    message: {
      required: "Event title is required",
      pattern: "Please enter a valid event title",
    },
  },
  eventDate: {
    required: true,
    future: true,
    message: {
      required: "Please select an event date",
      future: "Event date must be in the future",
    },
  },
  eventTime: {
    required: true,
    future: true,
    message: {
      required: "Please select an event time",
      future: "Event time must be in the future",
    },
  },
  eventDescription: {
    required: true,
    minlength: 10,
    maxlength: 500,
    pattern: /^.+$/,
    message: {
      required: "Event description is required",
      pattern: "Please enter a valid event description",
    },
  },
  eventAudience: {
    required: true,
    pattern: "",
    message: {
      required: "Please select event audience",
    },
  },
  eventTarget: {
    required: true,
    pattern: "",
    message: {
      required: "Please select event target",
    },
  },
  eventType: {
    required: true,
    pattern: "",
    message: {
      required: "Please select event type",
    },
  },
};
