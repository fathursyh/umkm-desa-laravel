<?php

namespace App\Notifications;

use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubmissionStatusChanged extends Notification
{
    use Queueable;

    protected $submission;

    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $status = ucfirst($this->submission->status);
        $message = match($this->submission->status) {
            'approved' => 'Your submission has been approved!',
            'rejected' => 'Your submission has been rejected.',
            'revision' => 'Your submission needs revision.',
            default => 'Your submission status has been updated.'
        };

        return (new MailMessage)
            ->subject("Submission Status: {$status}")
            ->greeting("Hello {$notifiable->name},")
            ->line($message)
            ->line("UMKM Name: {$this->submission->umkm_name}")
            ->when($this->submission->admin_notes, function($mail) {
                return $mail->line("Admin Notes: {$this->submission->admin_notes}");
            })
            ->action('View Submission', route('submissions.show', $this->submission))
            ->line('Thank you for using our application!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'submission_id' => $this->submission->id,
            'status' => $this->submission->status,
            'umkm_name' => $this->submission->umkm_name,
            'admin_notes' => $this->submission->admin_notes
        ];
    }
}
