<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;
use Illuminate\Http\Request;
use App\Models\Contact; // Import Contact model

class Order extends Resource
{
    public static $model = \App\Models\Order::class;

    public static $title = 'order_number';

    public static $search = [
        'id', 'order_number', 'email_address', 'payment_method'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Order Number')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('Sender', 'sender', User::class)
                ->sortable()
                ->searchable(),

            Select::make('Payment Method')
                ->options([
                    'cod' => 'Cash on Delivery',
                    'card' => 'Credit/Debit Card',
                ])
                ->displayUsingLabels(),

            Text::make('Email Address')
                ->rules('required', 'email'),

            Number::make('Subtotal')
                ->step(0.01)
                ->displayUsing(function ($value) {
                    return '$' . number_format($value, 2);
                }),

            Number::make('Shipping')
                ->step(0.01)
                ->displayUsing(function ($value) {
                    return '$' . number_format($value, 2);
                }),

            Number::make('Tax')
                ->step(0.01)
                ->displayUsing(function ($value) {
                    return '$' . number_format($value, 2);
                }),

            Number::make('Total')
                ->step(0.01)
                ->displayUsing(function ($value) {
                    return '$' . number_format($value, 2);
                }),

            BelongsTo::make('Product'),

            BelongsTo::make('Color'),

            BelongsTo::make('Size'),

            Number::make('Quantity')
                ->step(1)
                ->rules('required', 'min:1'),

            Select::make('Status')
                ->options([
                    0 => 'Pending',
                    1 => 'Processing',
                    2 => 'Shipped',
                    3 => 'Delivered',
                    4 => 'Completed',
                    5 => 'Cancelled',
                    6 => 'Failed',
                    7 => 'Refunded',
                    8 => 'On Hold',
                ])
                ->displayUsingLabels()
                ->rules('required'),

            // Contact IDs section (now using the Contact model)
            Text::make('Contacts', function () {
                $contacts = is_array($this->contact_ids) ? $this->contact_ids : json_decode($this->contact_ids, true);
                $contactList = '';

                if (empty($contacts)) {
                    return "Me";
                }

                foreach ($contacts as $contactId) {
                    $contactList .= $this->getContactNameById($contactId) . "<br>";
                }

                return $contactList;
            })->asHtml(),

            // Shipping Addresses Section
            Text::make('Shipping Addresses', function () {
                $addresses = is_array($this->shipping_addresses) ? $this->shipping_addresses : json_decode($this->shipping_addresses, true);
                $addressList = '<div style="padding: 10px; border: 1px solid var(--border-color); border-radius: 5px; background-color: var(--background-color); margin-top: 20px;">';
                $addressList .= '<table style="width: 100%; border-collapse: collapse; color: var(--text-color);">';
                $addressList .= '<thead><tr><th style="text-align: left; padding: 8px; border-bottom: 2px solid var(--border-color);">Name</th><th style="text-align: left; padding: 8px; border-bottom: 2px solid var(--border-color);">Address</th><th style="text-align: left; padding: 8px; border-bottom: 2px solid var(--border-color);">City</th><th style="text-align: left; padding: 8px; border-bottom: 2px solid var(--border-color);">Region</th><th style="text-align: left; padding: 8px; border-bottom: 2px solid var(--border-color);">Postal Code</th></tr></thead>';
                $addressList .= '<tbody>';

                if (empty($addresses)) {
                    $addressList .= '<tr><td colspan="5" style="padding: 8px; text-align: center;">Me</td></tr>';
                } else {
                    foreach ($addresses as $contactId => $address) {
                        $contactName = $this->getContactNameById($contactId);
                        $addressList .= "
                            <tr>
                                <td style='padding: 8px; border-bottom: 1px solid var(--border-color);'>{$contactName}</td>
                                <td style='padding: 8px; border-bottom: 1px solid var(--border-color);'>{$address['address']}</td>
                                <td style='padding: 8px; border-bottom: 1px solid var(--border-color);'>{$address['city']}</td>
                                <td style='padding: 8px; border-bottom: 1px solid var(--border-color);'>{$address['region']}</td>
                                <td style='padding: 8px; border-bottom: 1px solid var(--border-color);'>{$address['postal_code']}</td>
                            </tr>
                        ";
                    }
                }

                $addressList .= '</tbody></table></div>';
                return $addressList;
            })->asHtml(),

            // Notes Section
            Text::make('Notes', function () {
                $notes = is_array($this->notes) ? $this->notes : json_decode($this->notes, true);
                $notesList = '<div style="padding: 10px; border: 1px solid var(--border-color); border-radius: 5px; background-color: var(--background-color); margin-top: 20px;">';
                $notesList .= '<table style="width: 100%; border-collapse: collapse; color: var(--text-color);">';
                $notesList .= '<thead><tr><th style="text-align: left; padding: 8px; border-bottom: 2px solid var(--border-color);">Name</th><th style="text-align: left; padding: 8px; border-bottom: 2px solid var(--border-color);">Note</th></tr></thead>';
                $notesList .= '<tbody>';

                if (empty($notes)) {
                    $notesList .= '<tr><td colspan="2" style="padding: 8px; text-align: center;">Me</td></tr>';
                } else {
                    foreach ($notes as $contactId => $note) {
                        $contactName = $this->getContactNameById($contactId);
                        $notesList .= "
                            <tr>
                                <td style='padding: 8px; border-bottom: 1px solid var(--border-color);'>{$contactName}</td>
                                <td style='padding: 8px; border-bottom: 1px solid var(--border-color);'>{$note}</td>
                            </tr>
                        ";
                    }
                }

                $notesList .= '</tbody></table></div>';
                return $notesList;
            })->asHtml(),

            // Add Delivery Date field
            DateTime::make('Delivery Date')
                ->sortable()
                ->rules('nullable', 'date'),

            // Add Delivered At field (when the order is marked as delivered)
            DateTime::make('Delivered At')
                ->sortable()
                ->rules('nullable', 'date'),

            DateTime::make('Created At')->sortable(),
            DateTime::make('Updated At')->sortable(),
        ];
    }

    /**
     * Fetch the contact name from the Contact model based on the contact ID.
     */
    protected function getContactNameById($id)
    {
        $contact = Contact::find($id);
        return $contact ? $contact->name : 'Me'; // Return 'Me' if the contact is not found
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
