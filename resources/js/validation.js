/**
 * Frontend Validation Helper
 * Validasi form di client-side sebelum dikirim ke server
 */

/**
 * Validate booking form
 */
export function validateBookingForm(form) {
  const errors = {};
  const formData = new FormData(form);

  // Validate name
  const name = formData.get('name')?.trim();
  if (!name) {
    errors.name = 'Nama harus diisi';
  } else if (name.length < 3) {
    errors.name = 'Nama minimal 3 karakter';
  } else if (name.length > 191) {
    errors.name = 'Nama maksimal 191 karakter';
  }

  // Validate phone
  const phone = formData.get('phone')?.trim();
  if (phone && phone.length > 30) {
    errors.phone = 'Nomor HP maksimal 30 karakter';
  }
  if (phone && !/^[0-9+\-\s()]*$/.test(phone)) {
    errors.phone = 'Format nomor HP tidak valid';
  }

  // Validate date
  const date = formData.get('date');
  if (!date) {
    errors.date = 'Tanggal harus dipilih';
  } else {
    const selectedDate = new Date(date);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    if (selectedDate < today) {
      errors.date = 'Tanggal tidak boleh di masa lalu';
    }
  }

  // Validate people
  const people = parseInt(formData.get('people'));
  if (!people || people < 1) {
    errors.people = 'Jumlah orang minimal 1';
  } else if (people > 100) {
    errors.people = 'Jumlah orang maksimal 100';
  }

  // Validate children count if has_children is checked
  const hasChildren = formData.get('has_children') === 'on';
  if (hasChildren) {
    const childrenCount = parseInt(formData.get('children_count')) || 0;
    if (childrenCount < 1) {
      errors.children_count = 'Jumlah anak minimal 1 jika ada anak';
    } else if (childrenCount > people) {
      errors.children_count = 'Jumlah anak tidak boleh lebih dari jumlah orang';
    }
  }

  // Validate notes
  const notes = formData.get('notes');
  if (notes && notes.length > 1000) {
    errors.notes = 'Catatan maksimal 1000 karakter';
  }

  return {
    isValid: Object.keys(errors).length === 0,
    errors,
  };
}

/**
 * Validate tour form
 */
export function validateTourForm(form) {
  const errors = {};
  const formData = new FormData(form);

  // Validate title
  const title = formData.get('title')?.trim();
  if (!title) {
    errors.title = 'Judul tour harus diisi';
  } else if (title.length < 3) {
    errors.title = 'Judul minimal 3 karakter';
  } else if (title.length > 255) {
    errors.title = 'Judul maksimal 255 karakter';
  }

  // Validate description
  const description = formData.get('description');
  if (description && description.length < 10) {
    errors.description = 'Deskripsi minimal 10 karakter';
  }

  // Validate price
  const price = parseFloat(formData.get('price'));
  if (!price || price < 0) {
    errors.price = 'Harga harus diisi dan tidak boleh negatif';
  } else if (price > 999999999) {
    errors.price = 'Harga terlalu besar';
  }

  // Validate location
  const location = formData.get('location')?.trim();
  if (location && location.length > 255) {
    errors.location = 'Lokasi maksimal 255 karakter';
  }

  // Validate image if provided
  const imageFile = formData.get('image');
  if (imageFile && imageFile.size > 0) {
    const validMimes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!validMimes.includes(imageFile.type)) {
      errors.image = 'Gambar harus format JPG atau PNG';
    }
    if (imageFile.size > 2048000) {
      errors.image = 'Ukuran gambar maksimal 2MB';
    }
  }

  return {
    isValid: Object.keys(errors).length === 0,
    errors,
  };
}

/**
 * Display validation errors
 */
export function displayErrors(errors, formSelector) {
  const form = document.querySelector(formSelector);
  if (!form) return;

  // Clear previous error messages
  const previousErrors = form.querySelectorAll('.error-message');
  previousErrors.forEach((el) => el.remove());

  // Remove error classes
  form.querySelectorAll('.input-error').forEach((el) => {
    el.classList.remove('input-error');
  });

  // Display new errors
  Object.entries(errors).forEach(([field, message]) => {
    const input = form.querySelector(`[name="${field}"]`);
    if (input) {
      input.classList.add('input-error');
      const errorEl = document.createElement('p');
      errorEl.className = 'error-message text-red-600 text-sm mt-1';
      errorEl.textContent = message;
      input.parentElement.appendChild(errorEl);
    }
  });
}

/**
 * Clear validation errors
 */
export function clearErrors(formSelector) {
  const form = document.querySelector(formSelector);
  if (!form) return;

  const errors = form.querySelectorAll('.error-message');
  errors.forEach((el) => el.remove());

  form.querySelectorAll('.input-error').forEach((el) => {
    el.classList.remove('input-error');
  });
}
