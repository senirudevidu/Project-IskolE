export const validationRules = {
  //   User register
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
      required: "Email is required ",
      pattern: "Please enter valid email.",
    },
  },
  phone: {
    required: true,
    length: 10,
    pattern: /^0\d{9}$/,
    message: {
      required: "Enter your phone number (070xxxxxxx).",
      pattern: "Please enter valid phone number.",
    },
  },
  fName: {
    required: true,
    minlength: 3,
    maxlength: 30,
    pattern: /^[A-Za-z]+$/,
    message: {
      required: "Enter first name",
      pattern: "Please enter valid name(only letters)",
    },
  },
  lName: {
    required: true,
    minlength: 3,
    maxlength: 30,
    pattern: /^[A-Za-z]+$/,
    message: {
      required: "Enter last name",
      pattern: "Please enter valid name(only letters)",
    },
  },

  //Events
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
};
