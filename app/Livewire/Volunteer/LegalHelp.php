<?php

namespace App\Livewire\Volunteer;

use App\Models\Role;
use App\Models\User;
use App\Services\Messaging;
use Livewire\Component;

class LegalHelp extends Component
{
    public function requestLegalHelp()
    {
        // Find an available lawyer
        $lawyer = $this->findAvailableLawyer();
        
        if (!$lawyer) {
            session()->flash('error', 'No legal advisors are currently available. We will notify you when someone becomes available.');
            return;
        }

        // Get or create a direct chat with the lawyer
        $existingChat = Messaging::getDirectChatTo(auth()->user(), $lawyer);
        
        if (!$existingChat) {
            // Create a new chat if one doesn't exist
            Messaging::initializeDirectChatTo(auth()->user(), $lawyer);
            $chat = Messaging::getDirectChatTo(auth()->user(), $lawyer);
        } else {
            $chat = $existingChat;
        }

        if ($chat) {
            // Send an automated welcome message if this is a new chat
            if (!$existingChat) {
                Messaging::sendMessage(
                    "Hello! I'm reaching out for legal assistance. Could you please help me with a legal question?",
                    $chat->id
                );
                session()->flash('success', 'New chat created with ' . $lawyer->name . '. Welcome message sent!');
            } else {
                session()->flash('success', 'Reconnected with ' . $lawyer->name . '. Your previous conversation is ready.');
            }

            // Trigger the chat to open
            $this->dispatch('openChat', $chat->id);
            
        } else {
            session()->flash('error', 'Unable to establish chat connection. Please try again later or contact support.');
        }
    }

    private function findAvailableLawyer(): ?User
    {
        $lawyerRole = Role::where('name', 'lawyer')->first();
        
        if (!$lawyerRole) {
            return null;
        }

        // Find the first available lawyer
        // You can modify this logic to implement more sophisticated matching
        // such as round-robin, least busy, or specialty-based matching
        return User::where('role_id', $lawyerRole->id)
                   ->where('id', '!=', auth()->id()) // Don't match with self
                   ->first();
    }

    public function render()
    {
        return view('livewire.volunteer.legal-help');
    }
}