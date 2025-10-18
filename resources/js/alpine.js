import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'
import 'livewire-sortable'

Alpine.plugin(persist)

Livewire.start()
