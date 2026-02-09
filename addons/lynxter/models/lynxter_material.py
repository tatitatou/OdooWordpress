from odoo import fields, models
from odoo.exceptions import ValidationError

class Material(models.Model):
    _name = 'lynxter.material'
    _description = 'Description of material'

    name = fields.Char("Material Name", required=True)
    type = fields.Selection([
        ('FIL', 'Filament'),
        ('LIQ', 'Liquid'),
        ('PAS', 'Paste')
    ], string="Material Type", required=True)
    color = fields.Char("Color")
    manufacturer = fields.Char("Manufacturer")

    printer_ids = fields.Many2many(
        'lynxter.printer',
        relation='lynxter_printer_lynxter_material_rel',
        columns1='printer_id',
        columns2='material_id',
        string="Compatible printers"
    )

    #Vérifier si un matériel est compatible avec une imprimante donnée
    def _material_compatibility(self, printer):
        model = printer.model or ''

        if 'S600D' in model:
            return True
        
        compatibility_map = {
            'FIL': 'FIL',
            'LIQ': 'LIQ',
            'PAS': 'PAS',
        }

        return compatibility_map.get(self.type) in model
    
    # Bouton pour vérifier la compatibilité des matériaux avec les imprimantes sélectionnées
    def button_check_compatibility(self):
        for material in self:
            if not material.printer_ids:
                raise ValidationError("Please select at least one printer.")

            incompatible_printers = material.printer_ids.filtered(
                lambda p: not material._material_compatibility(p)
            )

            if incompatible_printers:
                names = ", ".join(incompatible_printers.mapped('model'))
                raise ValidationError(
                    f"The material is not compatible with the following printers: {names}"
                )
        return True

