@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta('Book a Consultation', 'Schedule a consultation with our financial and accounting experts to discuss your business needs.', 'book appointment, financial advice, expert consultation, accounting support') !!}
@endpush

@section('styles')
    <link rel="stylesheet" href="@versionedAsset('css/consultation.css')">
    @include('new.layouts.links')
    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        .success-message {
            background: white;
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .success-icon {
            font-size: 4rem;
            color: #10b981;
            margin-bottom: 1rem;
        }

        .success-content h3 {
            color: #1f2937;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .success-content p {
            color: #6b7280;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .schedule-another-btn {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .schedule-another-btn:hover {
            background: #2563eb;
        }

        .button-loader {
            color: #6b7280;
        }

        .schedule-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .day.disabled {
            color: #d1d5db !important;
            background: transparent !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
            opacity: 0.5;
        }

        .time-slot.disabled {
            border-color: #e5e7eb !important;
            background: #f3f4f6 !important;
            color: #9ca3af !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
            opacity: 0.6;
        }
    </style>
@endsection

@section('content')
    <div class="rka-scope">
        <main>
            <section class="consultation-section">
                <div class="container">
                    <div class="meeting-info gsap-animate" data-delay="0.2">
                        <div class="meeting-type">Business Consultation</div>
                        <div class="meeting-duration">15 Minutes</div>
                        <div class="meeting-format">Online Meeting</div>
                        <div>Ready for Better Accounting</div>
                    </div>

                    <div class="selected-time-banner" id="selectedTimeBanner"></div>

                    <div class="main-content">
                        <div class="calendar-section gsap-animate" id="calendarSection" data-delay="0.4">
                            <div class="calendar-header">
                                <button class="nav-button" id="prevMonth">‹</button>
                                <div class="month-year" id="monthYear"></div>
                                <button class="nav-button" id="nextMonth">›</button>
                            </div>

                            <div class="calendar-grid" id="calendar">
                                <div class="day-header">Sun</div>
                                <div class="day-header">Mon</div>
                                <div class="day-header">Tue</div>
                                <div class="day-header">Wed</div>
                                <div class="day-header">Thu</div>
                                <div class="day-header">Fri</div>
                                <div class="day-header">Sat</div>
                            </div>

                            <div class="timezone">Timezone Asia/Kathmandu</div>
                        </div>

                        <div class="time-slots-section" id="timeSlotsSection">
                            <div class="time-header">
                                <div class="selected-date" id="selectedDate"></div>
                                <div class="time-format-toggle">
                                    <button class="time-format-btn active" data-format="12h">12h</button>
                                    <button class="time-format-btn" data-format="24h">24h</button>
                                </div>
                            </div>

                            <div class="time-slots" id="timeSlots"></div>
                            <button class="next-button" id="nextButton">Next</button>
                        </div>

                        <div class="booking-form" id="bookingForm">
                            <h3>Enter Details</h3>

                            <form id="appointmentForm" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Your Name *</label>
                                    <input type="text" name="name" class="form-input" placeholder="Your Name"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Your Email *</label>
                                    <input type="email" name="email" class="form-input" placeholder="Your Email"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" name="phone" class="form-input" placeholder="Your Phone Number">
                                </div>

                                <input type="hidden" name="appointment_date" id="appointmentDateTime">

                                <div class="form-group">
                                    <label class="form-label">What is this meeting about?</label>
                                    <textarea name="message" class="form-input form-textarea" placeholder="Describe your consultation needs..."></textarea>
                                </div>

                                <button type="submit" class="schedule-button">
                                    <span class="button-text">Schedule Meeting</span>
                                    <span class="button-loader" style="display: none;">
                                        <i class="fas fa-spinner fa-spin"></i> Scheduling...
                                    </span>
                                </button>
                            </form>
                        </div>

                        <!-- Success Message -->
                        <div class="success-message" id="successMessage" style="display: none;">
                            <div class="success-content">
                                <i class="fas fa-check-circle success-icon"></i>
                                <h3>Appointment Scheduled Successfully!</h3>
                                <p id="appointmentDetails"></p>
                                <p>We will contact you soon to confirm your appointment.</p>
                                <button class="schedule-another-btn" onclick="resetForm()">Schedule Another</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        class MeetingScheduler {
            constructor() {
                this.currentDate = new Date();
                this.today = new Date();
                this.selectedDate = null;
                this.selectedTime = null;
                this.is24Hour = false;

                this.monthNames = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];

                this.dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

                this.initElements();
                this.initEventListeners();
                this.render();
                this.generateTimeSlots();
            }

            initElements() {
                this.monthYearEl = document.getElementById('monthYear');
                this.calendarEl = document.getElementById('calendar');
                this.prevBtn = document.getElementById('prevMonth');
                this.nextBtn = document.getElementById('nextMonth');
                this.timeSlotsSection = document.getElementById('timeSlotsSection');
                this.selectedDateEl = document.getElementById('selectedDate');
                this.timeSlotsEl = document.getElementById('timeSlots');
                this.nextButton = document.getElementById('nextButton');
                this.bookingForm = document.getElementById('bookingForm');
                this.selectedTimeBanner = document.getElementById('selectedTimeBanner');
                this.calendarSection = document.getElementById('calendarSection');
            }

            initEventListeners() {
                this.prevBtn.addEventListener('click', () => this.previousMonth());
                this.nextBtn.addEventListener('click', () => this.nextMonth());
                this.nextButton.addEventListener('click', () => this.showBookingForm());

                document.querySelectorAll('.time-format-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        document.querySelectorAll('.time-format-btn').forEach(b => b.classList.remove(
                            'active'));
                        e.target.classList.add('active');
                        this.is24Hour = e.target.dataset.format === '24h';
                        this.generateTimeSlots();
                    });
                });
            }

            previousMonth() {
                const prevMonthDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
                const currentMonthStart = new Date(this.today.getFullYear(), this.today.getMonth(), 1);
                if (prevMonthDate >= currentMonthStart) {
                    this.currentDate.setMonth(this.currentDate.getMonth() - 1);
                    this.render();
                }
            }

            nextMonth() {
                this.currentDate.setMonth(this.currentDate.getMonth() + 1);
                this.render();
            }

            render() {
                this.renderHeader();
                this.renderCalendar();
            }

            renderHeader() {
                const month = this.monthNames[this.currentDate.getMonth()];
                const year = this.currentDate.getFullYear();
                this.monthYearEl.textContent = `${month} ${year}`;

                // Hide prevMonth navigation button if the previous month is in the past
                const prevMonthDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
                const currentMonthStart = new Date(this.today.getFullYear(), this.today.getMonth(), 1);
                if (prevMonthDate < currentMonthStart) {
                    this.prevBtn.style.visibility = 'hidden';
                } else {
                    this.prevBtn.style.visibility = 'visible';
                }
            }

            renderCalendar() {
                const existingDays = this.calendarEl.querySelectorAll('.day');
                existingDays.forEach(day => day.remove());

                const year = this.currentDate.getFullYear();
                const month = this.currentDate.getMonth();

                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const daysInMonth = lastDay.getDate();
                const startingDayOfWeek = firstDay.getDay();

                const prevMonth = new Date(year, month, 0);
                const daysInPrevMonth = prevMonth.getDate();

                for (let i = startingDayOfWeek - 1; i >= 0; i--) {
                    const dayNum = daysInPrevMonth - i;
                    const dayEl = this.createDayElement(dayNum, 'other-month');
                    this.calendarEl.appendChild(dayEl);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const dayEl = this.createDayElement(day, 'current-month', year, month);

                    const currentDate = new Date(year, month, day);
                    if (this.isSameDate(currentDate, this.today)) {
                        dayEl.classList.add('today');
                    }

                    this.calendarEl.appendChild(dayEl);
                }

                const totalCells = this.calendarEl.children.length;
                const remainingCells = 42 - totalCells;

                for (let day = 1; day <= remainingCells && totalCells < 42; day++) {
                    const dayEl = this.createDayElement(day, 'other-month');
                    this.calendarEl.appendChild(dayEl);
                }
            }

            createDayElement(dayNum, monthClass, year, month) {
                const dayEl = document.createElement('div');
                dayEl.className = `day ${monthClass}`;
                dayEl.innerHTML = `<span>${dayNum}</span>`;

                if (monthClass === 'current-month') {
                    const todayStart = new Date(this.today.getFullYear(), this.today.getMonth(), this.today.getDate());
                    const cellDate = new Date(year, month, dayNum);

                    if (cellDate < todayStart) {
                        dayEl.classList.add('disabled');
                    } else {
                        dayEl.addEventListener('click', () => {
                            const prevSelected = this.calendarEl.querySelector('.day.selected');
                            if (prevSelected) {
                                prevSelected.classList.remove('selected');
                            }

                            dayEl.classList.add('selected');
                            this.selectedDate = new Date(year, month, dayNum);

                            this.calendarSection.classList.add('compact');
                            this.showTimeSlots();
                        });
                    }
                }

                return dayEl;
            }

            showTimeSlots() {
                this.timeSlotsSection.style.display = 'block';

                const dayName = this.dayNames[this.selectedDate.getDay()];
                const dayNum = this.selectedDate.getDate();
                this.selectedDateEl.textContent = `${dayName} ${dayNum}`;

                this.selectedTime = null;
                this.nextButton.style.display = 'none';
                this.updateSelectedTimeBanner();
                this.generateTimeSlots();
            }

            generateTimeSlots() {
                this.timeSlotsEl.innerHTML = '';

                const times = [];
                for (let hour = 9; hour < 17; hour++) {
                    for (let minute = 0; minute < 60; minute += 15) {
                        times.push({
                            hour,
                            minute
                        });
                    }
                }

                times.forEach(time => {
                    const timeSlot = document.createElement('div');
                    timeSlot.className = 'time-slot';
                    timeSlot.textContent = this.formatTime(time.hour, time.minute);

                    const now = new Date();
                    const slotDateTime = this.selectedDate ? new Date(
                        this.selectedDate.getFullYear(),
                        this.selectedDate.getMonth(),
                        this.selectedDate.getDate(),
                        time.hour,
                        time.minute
                    ) : null;

                    if (slotDateTime && slotDateTime < now) {
                        timeSlot.classList.add('disabled');
                    } else {
                        timeSlot.addEventListener('click', () => {
                            document.querySelectorAll('.time-slot').forEach(slot =>
                                slot.classList.remove('selected')
                            );

                            timeSlot.classList.add('selected');
                            this.selectedTime = {
                                hour: time.hour,
                                minute: time.minute
                            };
                            this.nextButton.style.display = 'block';
                            this.updateSelectedTimeBanner();
                        });
                    }

                    this.timeSlotsEl.appendChild(timeSlot);
                });
            }

            formatTime(hour, minute) {
                if (this.is24Hour) {
                    return `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                } else {
                    const ampm = hour >= 12 ? 'PM' : 'AM';
                    const displayHour = hour > 12 ? hour - 12 : (hour === 0 ? 12 : hour);
                    return `${displayHour}:${minute.toString().padStart(2, '0')} ${ampm}`;
                }
            }

            updateSelectedTimeBanner() {
                if (this.selectedDate && this.selectedTime) {
                    const startTime = this.formatTime(this.selectedTime.hour, this.selectedTime.minute);
                    const endHour = this.selectedTime.hour;
                    const endMinute = this.selectedTime.minute + 15;
                    const adjustedEndHour = endMinute >= 60 ? endHour + 1 : endHour;
                    const adjustedEndMinute = endMinute >= 60 ? endMinute - 60 : endMinute;
                    const endTime = this.formatTime(adjustedEndHour, adjustedEndMinute);

                    const monthName = this.monthNames[this.selectedDate.getMonth()];
                    const day = this.selectedDate.getDate();
                    const year = this.selectedDate.getFullYear();

                    this.selectedTimeBanner.textContent =
                        `${startTime} - ${endTime}, ${monthName} ${day}, ${year} Asia/Kathmandu`;
                    this.selectedTimeBanner.style.display = 'block';
                }
            }

            showBookingForm() {
                this.calendarSection.style.display = 'none';
                this.timeSlotsSection.style.display = 'none';
                this.bookingForm.style.display = 'block';

                // Set the appointment date and time in the hidden field
                if (this.selectedDate && this.selectedTime) {
                    const appointmentDateTime = new Date(
                        this.selectedDate.getFullYear(),
                        this.selectedDate.getMonth(),
                        this.selectedDate.getDate(),
                        this.selectedTime.hour,
                        this.selectedTime.minute
                    );

                    document.getElementById('appointmentDateTime').value = appointmentDateTime.toISOString();
                }
            }

            isSameDate(date1, date2) {
                return date1.getDate() === date2.getDate() &&
                    date1.getMonth() === date2.getMonth() &&
                    date1.getFullYear() === date2.getFullYear();
            }
        }

        // Form submission handler
        function handleAppointmentSubmission() {
            const form = document.getElementById('appointmentForm');
            const submitButton = form.querySelector('.schedule-button');
            const buttonText = submitButton.querySelector('.button-text');
            const buttonLoader = submitButton.querySelector('.button-loader');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                // Show loading state
                buttonText.style.display = 'none';
                buttonLoader.style.display = 'inline';
                submitButton.disabled = true;

                const formData = new FormData(form);

                try {
                    const response = await fetch('{{ route('appointments.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content') ||
                                document.querySelector('input[name="_token"]').value
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        // Show success message
                        document.getElementById('bookingForm').style.display = 'none';
                        document.getElementById('appointmentDetails').textContent =
                            `Your appointment is scheduled for ${result.data.appointment_date}`;
                        document.getElementById('successMessage').style.display = 'block';

                        // Animate success message
                        gsap.fromTo('#successMessage', {
                            opacity: 0,
                            scale: 0.8
                        }, {
                            opacity: 1,
                            scale: 1,
                            duration: 0.5,
                            ease: 'back.out(1.7)'
                        });

                    } else {
                        throw new Error(result.message || 'Failed to schedule appointment');
                    }

                } catch (error) {
                    alert('Error: ' + error.message);
                    console.error('Appointment submission error:', error);
                } finally {
                    // Reset button state
                    buttonText.style.display = 'inline';
                    buttonLoader.style.display = 'none';
                    submitButton.disabled = false;
                }
            });
        }

        // Reset form function
        function resetForm() {
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('bookingForm').style.display = 'none';
            document.getElementById('calendarSection').style.display = 'block';
            document.getElementById('calendarSection').classList.remove('compact');
            document.getElementById('timeSlotsSection').style.display = 'none';
            document.getElementById('selectedTimeBanner').style.display = 'none';

            // Reset form fields
            document.getElementById('appointmentForm').reset();

            // Clear selections
            document.querySelectorAll('.day.selected').forEach(day => day.classList.remove('selected'));
            document.querySelectorAll('.time-slot.selected').forEach(slot => slot.classList.remove('selected'));
        }

        document.addEventListener('DOMContentLoaded', () => {
            new MeetingScheduler();
            handleAppointmentSubmission();

            gsap.registerPlugin(ScrollTrigger);

            gsap.utils.toArray('.gsap-animate').forEach((el) => {
                const delay = parseFloat(el.getAttribute('data-delay')) || 0;
                gsap.fromTo(el, {
                    opacity: 0,
                    y: 20
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    delay,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 90%',
                        once: true,
                        invalidateOnRefresh: true
                    }
                });
            });

            ScrollTrigger.refresh();
        });
    </script>
@endsection
