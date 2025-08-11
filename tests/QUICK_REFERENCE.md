# Quick Test Reference Guide

## 🚀 Quick Start Commands

```bash
# Run all tests
php artisan test

# Run tests with detailed output
php artisan test --verbose

# Run tests in parallel (faster)
php artisan test --parallel

# Run tests with coverage report
php artisan test --coverage --min=80
```

---

## 📁 Run Tests by Category

### Authentication Tests
```bash
php artisan test tests/Feature/Auth
php artisan test tests/Feature/Auth/LoginTest.php
php artisan test tests/Feature/Auth/SignupTest.php
```

### Admin Tests
```bash
php artisan test tests/Feature/Admin
php artisan test tests/Feature/Admin/VolunteerManagementTest.php
php artisan test tests/Feature/Admin/DisputeHandlingTest.php
```

### Requester Tests
```bash
php artisan test tests/Feature/Requester
php artisan test tests/Feature/Requester/CreateEventTest.php
php artisan test tests/Feature/Requester/ApplicantsManagementTest.php
```

### Volunteer Tests
```bash
php artisan test tests/Feature/Volunteer
php artisan test tests/Feature/Volunteer/EventBrowsingTest.php
php artisan test tests/Feature/Volunteer/AchievementsTest.php
```

### Lawyer Tests
```bash
php artisan test tests/Feature/Lawyer
php artisan test tests/Feature/Lawyer/ContractDraftingTest.php
```

### Common Features Tests
```bash
php artisan test tests/Feature/Common
php artisan test tests/Feature/Common/ChatTest.php
php artisan test tests/Feature/Common/NotificationTest.php
```

---

## 🔍 Run Specific Tests

### By Test Method Name
```bash
php artisan test --filter user_can_login_with_valid_credentials
php artisan test --filter create_event
```

### By Test Group/Annotation
```bash
php artisan test --group auth
php artisan test --group admin
```

### Stop on First Failure
```bash
php artisan test --stop-on-failure
```

### Run Only Failed Tests
```bash
php artisan test --failed
```

---

## 📊 Coverage Reports

### Generate HTML Coverage Report
```bash
php artisan test --coverage-html coverage-report
```
Then open `coverage-report/index.html` in browser

### Console Coverage Summary
```bash
php artisan test --coverage
```

### Minimum Coverage Threshold
```bash
php artisan test --coverage --min=80
```

---

## 🐛 Debugging Tests

### Run Single Test with Debug
```bash
php artisan test --filter test_name --stop-on-failure -vvv
```

### Enable Debugging in PHPUnit
Add to your test:
```php
dump($variable);  // or
dd($variable);    // dump and die
```

### Check Database State During Test
```php
$this->assertDatabaseHas('users', ['email' => 'test@example.com']);
$this->assertDatabaseCount('users', 5);
```

---

## 🔧 Test Environment Setup

### Reset Test Database
```bash
php artisan migrate:fresh --env=testing
php artisan db:seed --env=testing
```

### Clear Test Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Refresh Configuration
```bash
php artisan config:cache
```

---

## 📝 Writing New Tests

### Test Template
```php
<?php

namespace Tests\Feature\YourModule;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class YourNewTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Setup code here
    }

    /** @test */
    public function your_test_description()
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $this->actingAs($user);
        $response = $this->get('/your-route');

        // Assert
        $response->assertStatus(200);
    }
}
```

### Using Test Helper
```php
use Tests\Helpers\TestHelper;

$admin = TestHelper::createAdmin();
$volunteer = TestHelper::createVolunteer();
$event = TestHelper::createPublishedEvent();
```

---

## 🔄 Continuous Integration

### GitHub Actions Example
```yaml
name: Tests

on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: 8.2
      - name: Install Dependencies
        run: composer install
      - name: Run Tests
        run: php artisan test --parallel
```

---

## ⚡ Performance Tips

### Run Tests in Parallel
```bash
php artisan test --parallel --processes=4
```

### Use SQLite for Faster Tests
In `phpunit.xml`:
```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

### Disable Unnecessary Services
```php
protected function setUp(): void
{
    parent::setUp();
    Mail::fake();
    Notification::fake();
    Event::fake();
}
```

---

## 📋 Pre-Commit Checklist

Before committing code:
```bash
# 1. Run all tests
php artisan test

# 2. Check code style
./vendor/bin/phpcs

# 3. Fix code style
./vendor/bin/phpcbf

# 4. Run static analysis
./vendor/bin/phpstan analyse

# 5. Check coverage
php artisan test --coverage --min=80
```

---

## 🔍 Common Test Failures & Solutions

### Database Connection Error
```bash
# Solution: Reset test database
php artisan migrate:fresh --env=testing
```

### Class Not Found
```bash
# Solution: Regenerate autoload
composer dump-autoload
```

### Session/Cache Issues
```bash
# Solution: Clear caches
php artisan cache:clear
php artisan config:clear
```

### Livewire Component Not Found
```bash
# Solution: Clear Livewire cache
php artisan livewire:discover
```

---

## 📈 Test Metrics to Track

- **Total Tests**: 202
- **Test Execution Time**: Target < 30 seconds
- **Code Coverage**: Target > 85%
- **Pass Rate**: Target 100%
- **Failed Tests**: Track and fix immediately

---

## 🎯 Testing Priorities

### Critical (Run Always)
- Authentication tests
- Authorization tests
- Payment/financial tests (if applicable)

### High Priority (Run Before Deployment)
- Event management tests
- User management tests
- Communication tests

### Medium Priority (Run Daily)
- Admin feature tests
- Profile tests
- Feedback tests

### Low Priority (Run Weekly)
- Gamification tests
- Analytics tests
- Reporting tests

---

## 🛠️ Useful Artisan Commands

```bash
# Create new test
php artisan make:test YourTest

# Create new test in specific directory
php artisan make:test Admin/NewAdminTest

# List all tests
php artisan test --list-tests

# Test specific method
php artisan test --filter=test_method_name

# Re-run last failed tests
php artisan test --failed
```

---

## 📚 Additional Resources

- [Laravel Testing Docs](https://laravel.com/docs/testing)
- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [Livewire Testing](https://livewire.laravel.com/docs/testing)
- [Pest PHP](https://pestphp.com/) (Alternative testing framework)

---

## 🎓 Best Practices

1. ✅ **One Assertion Per Test** (when possible)
2. ✅ **Use Descriptive Test Names**
3. ✅ **Arrange-Act-Assert Pattern**
4. ✅ **Test Edge Cases**
5. ✅ **Keep Tests Independent**
6. ✅ **Use Factories for Test Data**
7. ✅ **Mock External Services**
8. ✅ **Clean Up After Tests**

---

## 📞 Support

If you encounter issues:
1. Check test output for specific error
2. Review test logs in `storage/logs`
3. Consult team documentation
4. Ask in development channel

---

**Last Updated**: October 19, 2025  
**Maintained By**: Development Team
