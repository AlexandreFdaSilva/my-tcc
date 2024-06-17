from rdkit import Chem
from rdkit.Chem import Draw
import argparse


def create_molecule(smiles: str = "", inchi: str = ""):
    if smiles:
        m = Chem.MolFromSmiles(smiles)
        if m is not None:
            return Draw.MolsToGridImage(
                mols=[m], useSVG=True, subImgSize=(250, 250), molsPerRow=1
            )
    elif inchi:
        m = Chem.MolFromInchi(inchi)
        if m is not None:
            return Draw.MolsToGridImage(mols=[m], useSVG=True)


def molecule_to_image(smiles: str = "", inchi: str = ""):
    mol = create_molecule(inchi=inchi_input, smiles=smiles_input)
    return mol


parser = argparse.ArgumentParser()
parser.add_argument("--smiles", type=str, help="SMILES input")
parser.add_argument("--inchi", type=str, help="InChI input")
args = parser.parse_args()

smiles_input = args.smiles if args.smiles else ""
inchi_input = args.inchi if args.inchi else ""
svg_representation = create_molecule(inchi=inchi_input, smiles=smiles_input)

# Print SVG representation to standard output
print(svg_representation)
