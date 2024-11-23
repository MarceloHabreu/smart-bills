protected function schedule(Schedule $schedule)
{
$schedule->command('accounts:update-status')->daily();
}