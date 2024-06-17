-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.3.0 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table v1.molecules: ~32 rows (approximately)
INSERT INTO `molecules` (`id`, `name`, `class`, `stereochemistry`, `formula`, `smiles`, `inchi`, `methodology`, `iupac`, `molecular_weight`, `x_log_p`, `h_bond_donor_count`, `h_bond_acceptor_count`, `rotatable_bond_count`, `exact_mass`, `monoisotopic_mass`, `tpsa`, `heavy_atom_count`, `charge`, `complexity`, `isotope_atom_count`, `defined_atom_stereo_count`, `undefined_atom_stereo_count`, `defined_bond_stereo_count`, `undefined_bond_stereo_count`, `covalent_unit_count`, `status`, `notes`, `created_at`, `updated_at`) VALUES
	(1, 'brasimarin A', 'Coumarin', NULL, 'C24H22O5', 'CCCC1=CC(=O)OC2=C(C(=C3C=CC(OC3=C12)(C)C)O)C(=O)C4=CC=CC=C4', 'InChI=1S/C24H22O5/c1-4-8-15-13-17(25)28-23-18(15)22-16(11-12-24(2,3)29-22)21(27)19(23)20(26)14-9-6-5-7-10-14/h5-7,9-13,27H,4,8H2,1-3H3', 'in vitro', '6-benzoyl-5-hydroxy-2,2-dimethyl-10-propylpyrano[2,3-f]chromen-8-one', '390.4', '5.3', '1', '5', '4', '390.14672380', '390.14672380', '72.8', '29', '0', '715', '0', '0', '0', '0', '0', '1', 'not_initialized', 'aasdasd', NULL, '2024-05-20 22:04:18'),
	(2, 'brasimarins B', 'Coumarin', '', '	C25H26O6', 'CCC(C)C(=O)C1=C2C(=C3C(=C1O)CC(O3)C(C)(C)O)C(=CC(=O)O2)C4=CC=CC=C4', '1S/C25H26O6/c1-5-13(2)21(27)20-22(28)16-11-17(25(3,4)29)30-23(16)19-15(12-18(26)31-24(19)20)14-9-7-6-8-10-14/h6-10,12-13,17,28-29H,5,11H2,1-4H3', 'in vitro', '4-hydroxy-2-(2-hydroxypropan-2-yl)-5-(2-methylbutanoyl)-9-phenyl-2,3-dihydrofuro[2,3-f]chromen-7-one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(3, 'brasimarins C', 'Coumarin', '', '	C25H24O5', 'CC1C(OC2=C(C1=O)C3=C(C(=CC(=O)O3)C4=CC=CC=C4)C(=C2CC=C(C)C)O)C', '1S/C25H24O5/c1-13(2)10-11-17-23(28)20-18(16-8-6-5-7-9-16)12-19(26)30-25(20)21-22(27)14(3)15(4)29-24(17)21/h5-10,12,14-15,28H,11H2,1-4H3/t14-,15-/m1/s1', 'in vitro', '(8R,9R)-5-hydroxy-8,9-dimethyl-6-(3-methylbut-2-enyl)-4-phenyl-8,9-dihydropyrano[2,3-f]chromene-2,10-dione', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(4, '3,15-dioxo-21α-hydroxy friedelane', 'Terpene', '', '', '', '', 'in vivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(5, '3-oxo-11β,16β-diidróxi-urs-12-eno', 'Triterpens', NULL, '', '', '', 'in vivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(6, '3-oxo-11β-hidróxi-urs-12-eno', 'Triterpens', '', '', '', '', 'in vivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(7, '3-oxo-11β-hidróxi-olean-12-eno', 'Triterpens', '', '', '', '', 'in vivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(8, 'sorocein L ', 'Diels-Alder Type adducts', '', 'C39H38O9', 'Oc1ccc(c(O)c1)\\C=C\\c 4cc5OC6(Oc2c(ccc(O)c 2)[C@@H]3[C@@H]6[C@H ](/C=C( /C)C3)c5c(O)c 4)c7ccc(O)c(c7O)CCC( O)(C)C', '1S/C39H38O9/c1-20-14-27-25-9-8-24(41)19-33(25)47-39(29-10-11-30(42)26(37(29)45)12-13-38(2,3)46)36(27)28(15-20)35-32(44)16-21(17-34(35)48-39)4-5-22-6-7-23(40)18-31(22)43/h4-11,15-19,27-28,36,40-46H,12-14H2,1-3H3/b5-4+/t27-,28-,36-,39?/m1/s1', 'isolation and characterization', '(3aS,13bS,13cR)-8a-[2,4-Dihydroxy-3-(3-hydroxy-3-methylbutyl)phenyl]-6-[(E)-2-(2,4-dihydroxyphenyl)vinyl]-2-methyl-1,8a,13b,13c-tetrahydro-3aH-benzo[3,4]isochromeno[1,8-bc]chromene-4,11-diol', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(9, 'sorocein M', 'Diels-Alder Type adducts', '', 'C39H40O10', 'CC=1C[C@@H]([C@H]([C@H](C=1)c2c(O)cc(cc2O)\\C=C\\c3ccc(O)cc3O)C(=O)c4ccc(O)c(CCC(C)(C)O)c4O)c5ccc(O)cc5O', '1S/C39H40O10/c1-20-14-28(25-9-8-24(41)19-32(25)44)35(38(48)27-10-11-30(42)26(37(27)47)12-13-39(2,3)49)29(15-20)36-33(45)16-21(17-34(36)46)4-5-22-6-7-23(40)18-31(22)43/h4-11,15-19,28-29,35,40-47,49H,12-14H2,1-3H3/b5-4+/t28-,29+,35-/m1/s1', 'isolation and characterization', '[2,4-Dihydroxy-3-(3-hydroxy-3-methylbutyl)phenyl][(1R,2S,6S)-6-(2,4-dihydroxyphenyl)-2-{4-[(E)-2-(2,4-dihydroxyphenyl)vinyl]-2,6-dihydroxyphenyl}-4-methyl-3-cyclohexen-1-yl]methanone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(10, 'guttiferone A', 'Monoterpenoid', '', 'C38H50O6', 'CC(=CCCC1(C(CC2(C(=O)C(=C(C3=CC(=C(C=C3)O)O)O)C(=O)C1(C2=O)CC=C(C)C)CC=C(C)C)CC=C(C)C)C)', '1S/C38H50O6/c1-23(2)11-10-18-36(9)28(14-12-24(3)4)22-37(19-16-25(5)6)33(42)31(32(41)27-13-15-29(39)30(40)21-27)34(43)38(36,35(37)44)20-17-26(7)8/h11-13,15-17,21,28,39-41H,10,14,18-20,22H2,1-9H3/b32-31+/t28-,36+,37-,38+/m0/s1', 'in vivo', '(1R,5R,7R,8S)-3-(3,4-Dihydroxybenzoyl)-4-hydroxy-8-methyl-1,5,7-tris(3-methyl-2-buten-1-yl)-8-(4-methyl-3-penten-1-yl)bicyclo[3.3.1]non-3-ene-2,9-dione', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(11, 'friedelin ', 'Pentacyclic triterpenoid, cyclic terpene ketone', '', '	C30H50O', 'CC1C(=O)CCC2C1(CCC3C2(CCC4(C3(CCC5(C4CC(CC5)(C)C)C)C)C)C)C', '1S/C30H50O/c1-20-21(31)9-10-22-27(20,5)12-11-23-28(22,6)16-18-30(8)24-19-25(2,3)13-14-26(24,4)15-17-29(23,30)7/h20,22-24H,9-19H2,1-8H3/t20-,22+,23-,24+,26+,27+,28-,29+,30-/m0/s1', 'in vivo', '(4R,4aS,6aS,6bR,8aR,12aR,12bS,14aS,14bS)-4,4a,6b,8a,11,11,12b,14a-Octamethylicosahydro-3(2H)-picenone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(12, '1,5-dihydroxyxanthone ', 'Xanthone', '', 'C13H8O4', 'c1cc2c(=O)c3c(cccc3oc2c(c1)O)O', '1S/C13H8O4/c14-8-4-2-6-10-11(8)12(16)7-3-1-5-9(15)13(7)17-10/h1-6,14-15H', 'in vivo', '1,5-Dihydroxy-9H-xanthen-9-one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(13, 'I3-naringenin-II8-4\'-OMe-eriodictyol(GB-2a-II-4\'-OMe)', 'Biflavonoid', '', '', '', '', 'in vivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(14, '(R)-11-hydroxyeleutherine', 'Benzoisochromanequinone ', '', '', '', '', 'in vivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(15, 'kaempferol-3-O-β-arabinofuranoside', 'Flavonoid', '', '', '', '', 'in vitro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(16, 'quercetin-3-O-glucose ', 'Flavonoid', '', 'C23H22O13', 'CC(=O)OCC1C(C(C(C(O1)OC2=C(OC3=CC(=CC(=C3C2=O)O)O)C4=CC(=C(C=C4)O)O)O)O)O', '1S/C23H22O13/c1-8(24)33-7-15-17(29)19(31)20(32)23(35-15)36-22-18(30)16-13(28)5-10(25)6-14(16)34-21(22)9-2-3-11(26)12(27)4-9/h2-6,15,17,19-20,23,25-29,31-32H,7H2,1H3/t15?,17-,19-,20?,23+/m1/s1', 'in vitro', '[(3S,4R,6S)-6-[2-(3,4-dihydroxyphenyl)-5,7-dihydroxy-4-oxochromen-3-yl]oxy-3,4,5-trihydroxyoxan-2-yl]methyl acetate', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(17, 'p-coumaric acid ', 'Monohydroxycinnamic acid ', '', '	C9H8O3', 'C1=CC(=CC=C1C=CC(=O)O)O', '1S/C9H8O3/c10-8-4-1-7(2-5-8)3-6-9(11)12/h1-6,10H,(H,11,12)/b6-3+', 'in vitro', '(E)-3-(4-hydroxyphenyl)prop-2-enoic acid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(18, 'eudesmane ', 'Lignan', '', 'C15H28', 'CC1CCCC2(C1CC(CC2)C(C)C)C', '1S/C15H28/c1-11(2)13-7-9-15(4)8-5-6-12(3)14(15)10-13/h11-14H,5-10H2,1-4H3/t12-,13-,14+,15-/m1/s1', 'in vitro', '(3R,4aS,5R,8aR)-5,8a-dimethyl-3-propan-2-yl-2,3,4,4a,5,6,7,8-octahydro-1H-naphthalene', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(19, '1-(3,4-dimetoxyphenyl)-ethane-1,2-diol ', 'Alkyl-phenylketone', '', '	C10H14O4', 'COC1=C(C=C(C=C1)C(CO)O)OC', '1S/C10H14O4/c1-13-9-4-3-7(8(12)6-11)5-10(9)14-2/h3-5,8,11-12H,6H2,1-2H3', 'in vitro', '1-(3,4-dimethoxyphenyl)ethane-1,2-diol', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(20, '5-octa-2,4,6-triynyl-furan-2(5H)-one', 'Polyacetylene, Furanone, Ketone', NULL, '', NULL, NULL, 'in vitro, in vivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(21, '8′-hydroxy 3-4 dihydrovernoniyne', 'Polyacetylene, Furanone', NULL, NULL, NULL, NULL, 'in vitro, in vivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(22, 'eugenial C', 'meroterpenoids', NULL, 'C26H34O5', 'CCCC(=O)C1=C(C(=C(C(=C1O)C=O)O)C2(CCC3C2C4C(C4(C)C)CCC3=C)C)O', '1S/C26H34O5/c1-6-7-17(28)18-22(29)15(12-27)23(30)21(24(18)31)26(5)11-10-14-13(2)8-9-16-20(19(14)26)25(16,3)4/h12,14,16,19-20,29-31H,2,6-11H2,1,3-5H3/t14-,16+,19+,20+,26-/m0/s1', 'in vitro', '3-[(1aR,4aR,7S,7aR,7bR)-1,1,7-trimethyl-4-methylidene-1a,2,3,4a,5,6,7a,7b-octahydrocyclopropa[h]azulen-7-yl]-5-butanoyl-2,4,6-trihydroxybenzaldehyde', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(23, 'eugenial D', 'meroterpenoids', NULL, 'C26H34O5', 'CCCC(=O)C1=C(C(=C(C(=C1O)C2CCC(C3=CC(CCC23C)C(=C)C)C)O)C=O)O', '1S/C26H34O5/c1-6-7-20(28)22-24(30)17(13-27)23(29)21(25(22)31)18-9-8-15(4)19-12-16(14(2)3)10-11-26(18,19)5/h12-13,15-16,18,29-31H,2,6-11H2,1,3-5H3/t15-,16-,18-,26-/m0/s1', 'in vitro', '3-[(1R,4S,6S,8aS)-4,8a-dimethyl-6-prop-1-en-2-yl-2,3,4,6,7,8-hexahydro-1H-naphthalen-1-yl]-5-butanoyl-2,4,6-trihydroxybenzaldehyde', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(24, 'brasixanthones A', 'Xanthone', NULL, 'C24H24O6', 'O=C1c4cc(c(O)c(OC)c4Oc3c1c(O)c2\\C=C/C(Oc2c3)(C)C)C\\C=C(/C)C', '1S/C24H24O6/c1-12(2)6-7-13-10-15-21(27)18-17(29-22(15)23(28-5)19(13)25)11-16-14(20(18)26)8-9-24(3,4)30-16/h6,8-11,25-26H,7H2,1-5H3', 'in vitro', '5,9-Dihydroxy-10-methoxy-2,2-dimethyl-8-(3-methyl-2-buten-1-yl)-2H,6H-pyrano[3,2-b]xanthen-6-one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(25, 'brasixanthones B', 'Xanthone', NULL, 'C23H22O5', 'CC(=CCC1=C2C(=C(C3=C1OC4=C(C3=O)C=C(C=C4)O)O)C=CC(O2)(C)C)C', '1S/C23H22O5/c1-12(2)5-7-15-21-14(9-10-23(3,4)28-21)19(25)18-20(26)16-11-13(24)6-8-17(16)27-22(15)18/h5-6,8-11,24-25H,7H2,1-4H3', 'in vitro', '5,8-Dihydroxy-2,2-dimethyl-12-(3-methyl-2-buten-1-yl)-2H,6H-pyrano[3,2-b]xanthen-6-one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(26, 'brasixanthone C', 'Xanthone', NULL, 'C23H22O7', 'CC(=C)C(CC1=C2C(=C(C3=C1OC4=C(C3=O)C=C(C=C4)O)O)C=CC(O2)(C)C)OO', '1S/C23H22O7/c1-11(2)17(30-27)10-15-21-13(7-8-23(3,4)29-21)19(25)18-20(26)14-9-12(24)5-6-16(14)28-22(15)18/h5-9,17,24-25,27H,1,10H2,2-4H3', 'in vitro', '12-(2-Hydroperoxy-3-methyl-3-buten-1-yl)-5,8-dihydroxy-2,2-dimethyl-2H,6H-pyrano[3,2-b]xanthen-6-one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(27, 'brasixanthone D', 'Xanthone', NULL, '	C24H24O7', 'CC1(C=CC2=C(C3=C(C(=C2O1)CC(C4C(O4)(C)C)O)OC5=C(C3=O)C=C(C=C5)O)O)C', '1S/C24H24O7/c1-23(2)8-7-12-18(27)17-19(28)13-9-11(25)5-6-16(13)29-21(17)14(20(12)30-23)10-15(26)22-24(3,4)31-22/h5-9,15,22,25-27H,10H2,1-4H3/t15?,22-/m0/s1', 'in vitro', '12-[2-[(2S)-3,3-dimethyloxiran-2-yl]-2-hydroxyethyl]-5,8-dihydroxy-2,2-dimethylpyrano[3,2-b]xanthen-6-one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(28, 'brasixanthone E', 'Xanthone', NULL, 'C24H24O6', 'C/C(C)=C\\Cc2c4OC(C)(C)\\C=C/c4c(O)c1C(=O)c3cc(OC)c(O)cc3Oc12', '1S/C24H24O6/c1-12(2)6-7-14-22-13(8-9-24(3,4)30-22)20(26)19-21(27)15-10-18(28-5)16(25)11-17(15)29-23(14)19/h6,8-11,25-26H,7H2,1-5H3', 'in vitro', '5,9-Dihydroxy-8-methoxy-2,2-dimethyl-12-(3-methyl-2-buten-1-yl)-2H,6H-pyrano[3,2-b]xanthen-6-one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(29, 'brasixanthone F', 'Xanthone', NULL, 'C19H16O6', 'O=C1c4cc(OC)c(O)cc4Oc3c1c(O)c2\\C=C/C(Oc2c3)(C)C', '1S/C19H16O6/c1-19(2)5-4-9-13(25-19)8-15-16(17(9)21)18(22)10-6-14(23-3)11(20)7-12(10)24-15/h4-8,20-21H,1-3H3', 'in vitro', '5,9-Dihydroxy-8-methoxy-2,2-dimethyl-2H,6H-pyrano[3,2-b]xanthen-6-one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(30, 'brasixanthone G', 'Xanthone', NULL, 'C24H26O7', 'CC(=CCc1cc2c(=O)c3c(cc(c(c3O)CC(C(=C)C)O)O)oc2c(c1O)OC)C', '1S/C24H26O7/c1-11(2)6-7-13-8-15-22(29)19-18(31-23(15)24(30-5)20(13)27)10-17(26)14(21(19)28)9-16(25)12(3)4/h6,8,10,16,25-28H,3,7,9H2,1-2,4-5H3', 'in vitro', '1,3,6-Trihydroxy-2-(2-hydroxy-3-methyl-3-buten-1-yl)-5-methoxy-7-(3-methyl-2-buten-1-yl)-9H-xanthen-9-one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(31, '(-)-21-O-Methyl-limonexic acid', 'Limonoid', NULL, NULL, NULL, NULL, 'in vitro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, NULL, NULL),
	(32, 'TESTE APENAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_initialized', NULL, '2024-05-14 23:40:57', '2024-05-14 23:58:41');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
