# Test Suite Documentation

This directory contains comprehensive test coverage for the Smile volunteering platform. All tests are organized by user roles and features.

## Directory Structure

```
tests/
├── Feature/
│   ├── Auth/                      # Authentication & Authorization Tests
│   │   ├── LoginTest.php
│   │   ├── SignupTest.php
│   │   ├── ForgotPasswordTest.php
│   │   └── ResetPasswordTest.php
│   │
│   ├── Common/                    # Shared Features Tests
│   │   ├── ChatTest.php
│   │   ├── ChatbotTest.php
│   │   ├── NotificationTest.php
│   │   └── HelpSupportTest.php
│   │
│   ├── Admin/                     # Admin Role Tests
│   │   ├── AdminDashboardTest.php
│   │   ├── VolunteerManagementTest.php
│   │   ├── EventManagementTest.php
│   │   └── DisputeHandlingTest.php
│   │
│   ├── Lawyer/                    # Lawyer Role Tests
│   │   ├── LawyerDashboardTest.php
│   │   ├── ContractDraftingTest.php
│   │   ├── DigitalSignatureTest.php
│   │   └── LegalQATest.php
│   │
│   ├── Requester/                 # Event Organizer Tests
│   │   ├── RequesterDashboardTest.php
│   │   ├── CreateEventTest.php
│   │   ├── ApplicantsManagementTest.php
│   │   └── CertificateManagementTest.php
│   │
│   └── Volunteer/                 # Volunteer Role Tests
│       ├── VolunteerDashboardTest.php
│       ├── EventBrowsingTest.php
│       ├── AchievementsTest.php
│       ├── LeaderboardTest.php
│       ├── FeedbackTest.php
│       ├── ReviewsTest.php
│       └── ProfileTest.php
│
└── Unit/                          # Unit Tests (Model, Service, etc.)
```

## Test Coverage Summary

### Authentication Tests (Auth/)
**File: LoginTest.php** (13 tests)
- ✓ Login page rendering
- ✓ Valid/invalid credential handling
- ✓ Email and password validation
- ✓ Remember me functionality
- ✓ Rate limiting after failed attempts
- ✓ Disabled user prevention
- ✓ Redirect after login
- ✓ Guest middleware

**File: SignupTest.php** (11 tests)
- ✓ Registration with valid data
- ✓ Field validations (name, email, password)
- ✓ Email uniqueness check
- ✓ Password confirmation
- ✓ Password strength requirements
- ✓ Role selection during signup
- ✓ Email verification flow

**File: ForgotPasswordTest.php** (7 tests)
- ✓ Password reset link request
- ✓ Email validation
- ✓ Rate limiting
- ✓ Non-existent email handling
- ✓ Reset notification

**File: ResetPasswordTest.php** (9 tests)
- ✓ Password reset with valid token
- ✓ Invalid/expired token handling
- ✓ Password validation and confirmation
- ✓ Token reuse prevention

---

### Common Features Tests (Common/)
**File: ChatTest.php** (8 tests)
- ✓ One-to-one messaging
- ✓ File attachments
- ✓ Chat history and pagination
- ✓ Access control
- ✓ Real-time message updates

**File: NotificationTest.php** (8 tests)
- ✓ Notification listing
- ✓ Mark as read/unread
- ✓ Mark all as read
- ✓ Delete notifications
- ✓ Ordering (newest first)
- ✓ Access control

**File: ChatbotTest.php** (7 tests)
- ✓ AI prompt submission
- ✓ Conversation context
- ✓ Rate limiting
- ✓ Error handling
- ✓ Clear history

**File: HelpSupportTest.php** (9 tests)
- ✓ Create support tickets
- ✓ Attach files
- ✓ View ticket list
- ✓ View ticket details
- ✓ Reply to tickets
- ✓ Close tickets
- ✓ Access control

---

### Admin Tests (Admin/)
**File: AdminDashboardTest.php** (7 tests)
- ✓ Dashboard access control
- ✓ Key metrics display
- ✓ Date range filtering
- ✓ Recent activities
- ✓ Data export

**File: VolunteerManagementTest.php** (9 tests)
- ✓ View all volunteers
- ✓ Approve/reject volunteers
- ✓ Suspend volunteers
- ✓ Filter by status
- ✓ Search by name
- ✓ Bulk operations

**File: EventManagementTest.php** (7 tests)
- ✓ View event details
- ✓ Approve/reject events
- ✓ Cancel events
- ✓ View participants
- ✓ Moderate reviews

**File: DisputeHandlingTest.php** (8 tests)
- ✓ View disputes
- ✓ Assign to handler
- ✓ Resolve disputes
- ✓ Attach evidence
- ✓ Filter by status
- ✓ Add notes

---

### Lawyer Tests (Lawyer/)
**File: LawyerDashboardTest.php** (4 tests)
- ✓ Dashboard access
- ✓ View assigned contracts
- ✓ Pending matters

**File: ContractDraftingTest.php** (8 tests)
- ✓ Create from template
- ✓ Insert clauses
- ✓ Save versions
- ✓ Compare versions
- ✓ Search clause library

**File: DigitalSignatureTest.php** (8 tests)
- ✓ Initiate signing process
- ✓ Add signers
- ✓ Sign documents
- ✓ View signing status
- ✓ Download signed contract
- ✓ Revoke signature request

**File: LegalQATest.php** (6 tests)
- ✓ View questions
- ✓ Answer questions
- ✓ Mark accepted answer
- ✓ Filter by tag

---

### Requester Tests (Requester/)
**File: RequesterDashboardTest.php** (4 tests)
- ✓ Dashboard access
- ✓ Display metrics
- ✓ Upcoming events

**File: CreateEventTest.php** (14 tests)
- ✓ Create event with all fields
- ✓ Field validations
- ✓ Date validations
- ✓ Image upload
- ✓ Save as draft
- ✓ Add required skills
- ✓ Volunteer slots validation

**File: ApplicantsManagementTest.php** (9 tests)
- ✓ View applicants
- ✓ Accept/reject/waitlist
- ✓ Message applicants
- ✓ Filter by status
- ✓ Bulk operations
- ✓ Access control

**File: CertificateManagementTest.php** (7 tests)
- ✓ View issued certificates
- ✓ Issue new certificate
- ✓ View details
- ✓ Download certificate
- ✓ Revoke certificate
- ✓ Filter by event

---

### Volunteer Tests (Volunteer/)
**File: VolunteerDashboardTest.php** (5 tests)
- ✓ Dashboard access
- ✓ Recommended events
- ✓ Upcoming events
- ✓ Statistics display

**File: EventBrowsingTest.php** (10 tests)
- ✓ Browse events
- ✓ Search by keyword
- ✓ Filter by date/location
- ✓ Apply to events
- ✓ Withdraw application
- ✓ Full/closed event handling
- ✓ Duplicate application prevention

**File: AchievementsTest.php** (5 tests)
- ✓ View badges
- ✓ View achievement details
- ✓ View milestones
- ✓ Progress tracking

**File: LeaderboardTest.php** (5 tests)
- ✓ View leaderboard
- ✓ Top volunteers display
- ✓ Filter by time range
- ✓ View personal rank

**File: FeedbackTest.php** (7 tests)
- ✓ Submit event feedback
- ✓ Rating validation
- ✓ Duplicate prevention
- ✓ Attendance verification
- ✓ Rate organizer

**File: ReviewsTest.php** (6 tests)
- ✓ View received reviews
- ✓ View given reviews
- ✓ Respond to reviews
- ✓ Dispute reviews
- ✓ Average rating

**File: ProfileTest.php** (10 tests)
- ✓ Update profile
- ✓ Add skills
- ✓ Update availability
- ✓ Upload profile picture
- ✓ Upload certifications
- ✓ Update password
- ✓ Notification preferences

---

## Running Tests

### Run All Tests
```bash
php artisan test
```

### Run Specific Test Suite
```bash
# Run all Auth tests
php artisan test tests/Feature/Auth

# Run all Admin tests
php artisan test tests/Feature/Admin

# Run all Volunteer tests
php artisan test tests/Feature/Volunteer
```

### Run Specific Test File
```bash
php artisan test tests/Feature/Auth/LoginTest.php
```

### Run Specific Test Method
```bash
php artisan test --filter user_can_login_with_valid_credentials
```

### Run with Coverage
```bash
php artisan test --coverage
```

### Run in Parallel
```bash
php artisan test --parallel
```

---

## Test Database Setup

Tests use a separate testing database configured in `phpunit.xml`:

```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

Each test uses the `RefreshDatabase` trait to ensure a clean database state.

---

## Test Data Factories

All tests utilize Laravel factories for creating test data:
- `UserFactory` - Create test users with different roles
- `EventFactory` - Create test events
- `ApplicationFactory` - Create volunteer applications
- `CertificateFactory` - Create certificates
- `BadgeFactory` - Create achievement badges
- And more...

---

## Key Testing Patterns

### 1. Authentication Testing
```php
$this->actingAs($user); // Authenticate user for test
```

### 2. Livewire Component Testing
```php
Volt::test('component-name')
    ->set('property', 'value')
    ->call('method')
    ->assertHasNoErrors();
```

### 3. Authorization Testing
```php
$response = $this->actingAs($user)->get('/protected-route');
$response->assertStatus(403);
```

### 4. Database Assertions
```php
$this->assertDatabaseHas('table', ['column' => 'value']);
$this->assertDatabaseMissing('table', ['column' => 'value']);
```

---

## Test Naming Convention

All test methods follow the pattern:
```php
/** @test */
public function descriptive_test_name_in_snake_case()
```

---

## Continuous Integration

These tests are designed to run in CI/CD pipelines:
- GitHub Actions
- GitLab CI
- Jenkins
- CircleCI

Sample GitHub Actions workflow:
```yaml
- name: Run Tests
  run: php artisan test --parallel
```

---

## Coverage Goals

Target coverage by module:
- **Authentication**: 95%+
- **Authorization**: 90%+
- **Core Features**: 85%+
- **UI Components**: 75%+

---

## Contributing

When adding new features:
1. Write tests first (TDD approach)
2. Ensure all tests pass
3. Maintain naming conventions
4. Update this documentation

---

## Test Statistics

- **Total Test Files**: 27
- **Total Test Cases**: ~200+
- **Average Execution Time**: ~30 seconds
- **Coverage**: Target 85%+

---

## Troubleshooting

### Tests Failing Due to Database
```bash
php artisan migrate:fresh --env=testing
```

### Clear Test Cache
```bash
php artisan test:clear-cache
```

### Debug Specific Test
```bash
php artisan test --filter test_name --stop-on-failure
```

---

## Additional Resources

- [Laravel Testing Documentation](https://laravel.com/docs/testing)
- [Livewire Testing Documentation](https://livewire.laravel.com/docs/testing)
- [Pest PHP Documentation](https://pestphp.com/)

---

**Last Updated**: October 19, 2025
**Maintained by**: Development Team
